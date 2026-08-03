<?php

namespace App\Http\Controllers\Front;

use App\Dtos\DoorDto;
use App\Dtos\SliderDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessage\SendContactMessageRequest;
use App\Http\Requests\Newsletter\SubscribeRequest;
use App\Models\Certificate;
use App\Models\ContactMessage;
use App\Models\Door;
use App\Models\EmailSubscriber;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\ResourcePage;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();

        $page = Cache::remember("homepage_data_{$locale}", 3600, function () {
            return Page::withTranslation()->findOrFail(1);
        });

        $sliders = Cache::remember("homepage_sliders_data_{$locale}", 3600, function () {
            $slider = Slider::with('image')->where('status', 1)->orderBy('order', 'ASC')->get();
            return $slider->map(fn($item) => SliderDto::fromModel($item))->all();
        });

        $doors = Cache::remember("homepage_doors_data_{$locale}", 3600, function () {
            $door = Door::with('image')->where('status', 1)->get();
            return $door->map(fn($item) => DoorDto::fromModel($item))->all();
        });

        return view('front.homepage', compact('sliders', 'doors', 'page'));
    }

    public function doorSingle(string $slug)
    {
        $door = Door::with('image', 'spesificationImage', 'variants.miniPicture', 'variants.picture', 'spesifications')->whereTranslation('slug', $slug)->firstOrFail();
        $relatedDoors = Door::with('image')
            ->where('status', 1)
            ->where('id', '!=', $door->id)
            ->has('variants', '>', 0)
            ->limit(3)
            ->get();

        return view('front.door-single', compact('door', 'relatedDoors'));
    }

    public function resources()
    {
        $locale = app()->getLocale();
        $pages = Cache::remember("resources_pages_{$locale}", 3600, function () {
            return ResourcePage::with('image')->get();
        });

        return view('front.resources', compact('pages'));
    }

    public function whyWpcDoors()
    {
        $locale = app()->getLocale();
        $page = Cache::remember("why_wpc_page_{$locale}", 3600, function () {
            return Page::findOrFail(2);
        });
        return view('front.why-wpc-doors', compact('page'));
    }

    public function about()
    {
        $locale = app()->getLocale();
        $page = Cache::remember("about_us_page_{$locale}", 3600, function () {
            return Page::findOrFail(3);
        });

        return view('front.about', compact('page'));
    }

    public function contact()
    {
        $locale = app()->getLocale();
        $page = Cache::remember("contact_page_{$locale}", 3600, function () {
            return Page::findOrFail(4);
        });
        return view('front.contact', compact('page'));
    }

    public function sendContact(SendContactMessageRequest $request)
    {
        try {
            ContactMessage::create($request->validated());
            return redirect()->back()->withSuccess("Message was sent successfully");
        } catch (\Exception $exception) {
            Log::error("An error occured while contact message sending: " . $exception->getMessage(), ['exception' => $exception]);
            return redirect()->back()->withError("An error occured while sending message");
        }
    }

    public function resourcesSingle(string $slug, Request $request)
    {
        $page = ResourcePage::whereTranslation('slug', $slug, app()->getLocale())
            ->with('image')->firstOrFail();

        $referenceSlug = $page->translate('en')->slug;

        switch ($referenceSlug) {
            case "installation":
                return view('front.resources.installation', compact('page'));
                break;

            case "fire-resistance-test":
                return view('front.resources.fire-resistence-test', compact('page'));
                break;

            case "warranty-and-return-policy":
                return view('front.resources.warranty', compact('page'));
                break;

            case "technical-and-certificates":
                $query = Certificate::where('status', 1);

                if ($request->filled('category')) {
                    $query->where('category', $request->category);
                }

                if ($request->filled('search')) {
                    $search = $request->search;
                    $query->where(function ($q) use ($search) {
                        $q->where('title', 'LIKE', "%{$search}%")
                            ->orWhere('description', 'LIKE', "%{$search}%")
                            ->orWhere('type', 'LIKE', "%{$search}%");
                    });
                }

                $documents = $query->orderBy('order', 'ASC')->paginate(10)->withQueryString();

                return view('front.resources.technical-and-certificates', compact('page', 'documents'));
                break;

            case "gallery":

                $images = Gallery::orderBy('created_at', 'desc')->paginate(12);
                return view('front.resources.gallery', compact('page', 'images'));
                break;

            case "digital-catalog":
                return view('front.resources.digital-catalog', compact('page'));
                break;

            default:
                abort(404);
                break;
        }
    }

    public function newsletterSubscribe(SubscribeRequest $request)
    {
        try {
            EmailSubscriber::create($request->validated());
            return response()->json(['status' => 'success']);
        } catch (\Exception $exception) {
            Log::error('An error occured while subscribing newsletter: ' . $exception->getMessage(), ['exception' => $exception]);

            return response()->json([
                'message' => "An error occured."
            ], 500);
        }
    }

    public function newsletterVerify(string $token)
    {
        $sub = EmailSubscriber::where('verification_token', $token)->firstOrFail();
        $sub->status = 1;
        $sub->verified_at = now();
        $sub->save();

        return redirect()->route('home')->with('success', __('messages.newsletter-form.newsletter_verified'));
    }
}
