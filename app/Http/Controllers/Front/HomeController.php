<?php

namespace App\Http\Controllers\Front;

use App\Dtos\SliderDto;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Cache::remember('homepage_sliders_data', 3600, function () {
            $slider = Slider::with('image')->where('status', 1)->orderBy('order', 'ASC')->get();
            return $slider->map(fn($item) => SliderDto::fromModel($item))->all();
        });

        return view('front.homepage', compact('sliders'));
    }
}
