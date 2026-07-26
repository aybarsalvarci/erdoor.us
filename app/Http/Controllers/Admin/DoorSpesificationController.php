<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoorSpesification\CreateDoorSpesificationRequest;
use App\Models\Door;
use Illuminate\Support\Facades\Log;

class DoorSpesificationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDoorSpesificationRequest $request, int $id)
    {
        $door = Door::findOrFail($id);

        try {
            $door->spesifications()->create($request->validated());
            return redirect()->back()->with([
                'success' => "Door spesification created successfully",
                'tab' => 'specs'
            ]);
        } catch (\Exception $exception) {
            Log::error("Door spesification creation failed: " . $exception->getMessage(), ['exception' => $exception]);
            return redirect()->back()->with([
                'error' => "An error occured while creating Door Spesification",
                'tab' => 'specs'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
