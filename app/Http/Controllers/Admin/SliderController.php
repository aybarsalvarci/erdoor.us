<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\CreateSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sliders = Slider::with('image')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('alt_text', 'like', '%' . $request->search . '%')
                    ->orWhere('url', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->paginate(12);
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSliderRequest $request)
    {
        try {
            Slider::create($request->validated());
            return redirect()->route('admin.slider.index')->with('success', 'Slider created successfully.');
        } catch (\Exception $exception) {
            Log::error('Slider create error: ' . $exception->getMessage(), ['exception' => $exception]);
            return redirect()->route('admin.slider.index')->with('error', 'An error occurred while creating slider.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::with('image')->findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, string $id)
    {
        $slider = Slider::findOrFail($id);

        try {
            $slider->update($request->validated());
            return redirect()->back()->with('success', 'Slider updated successfully.');
        } catch (\Exception $exception) {
            Log::error('Slider update error: ' . $exception->getMessage(), ['exception' => $exception]);
            return redirect()->back()->with('error', 'An error occurred while updating slider.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);

        try {
            $slider->delete();
            return redirect()->back()->with('success', 'Slider deleted successfully.');
        } catch (\Exception $exception) {
            Log::error('Slider delete error: ' . $exception->getMessage(), ['exception' => $exception]);
            return redirect()->back()->with('error', 'An error occurred while deleting slider.');
        }
    }
}
