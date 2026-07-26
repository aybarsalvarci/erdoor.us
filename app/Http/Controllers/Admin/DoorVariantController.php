<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoorVariant\CreateDoorVariantRequest;
use App\Models\Door;
use App\Models\DoorVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoorVariantController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDoorVariantRequest $request, int $doorId)
    {
        $door = Door::findOrFail($doorId);

        try {
            $door->variants()->create($request->validated());
            return redirect()->route('admin.door.edit', $doorId)->with([
               'success' => 'Door variant created successfully',
               'tab' => 'variants'
            ]);
        }
        catch (\Exception $e) {
            Log::error('Door variant create error: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withError("Door variant create error");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $doorId, int $variantId)
    {
        $variant = DoorVariant::where('id', $variantId)->firstOrFail();

        try {
            $variant->delete();
            return redirect()->route('admin.door.edit', $doorId)->with([
                'success' => 'Door variant deleted successfully',
                'tab' => 'variants'
            ]);
        }
        catch (\Exception $e) {
            Log::error('Door variant delete error: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->route('admin.door.edit', $doorId)->with([
                'error' => 'Door variant delete error',
                'tab' => 'variants'
            ]);
        }
    }
}
