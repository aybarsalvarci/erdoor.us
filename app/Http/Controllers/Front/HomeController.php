<?php

namespace App\Http\Controllers\Front;

use App\Dtos\DoorDto;
use App\Dtos\SliderDto;
use App\Http\Controllers\Controller;
use App\Models\Door;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();

        $sliders = Cache::remember("homepage_sliders_data_{$locale}", 3600, function () {
            $slider = Slider::with('image')->where('status', 1)->orderBy('order', 'ASC')->get();
            return $slider->map(fn($item) => SliderDto::fromModel($item))->all();
        });

        $doors = Cache::remember("homepage_doors_data_{$locale}", 3600, function () {
            $door = Door::with('image')->where('status', 1)->get();
            return $door->map(fn($item) => DoorDto::fromModel($item))->all();
        });

        return view('front.homepage', compact('sliders', 'doors'));
    }
}
