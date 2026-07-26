<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Door\CreateDoorRequest;
use App\Models\Door;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doors = Door::with('image')->paginate(10);

        return view('admin.door.index', compact('doors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.door.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDoorRequest $request)
    {
        try {
            $door = Door::create($request->validated());
            return redirect()->route('admin.door.edit', $door->id)->withSuccess('Door successfully created.')
                ->withTab('variants');
        } catch (\Exception $exception) {
            Log::error("Door create error " . $exception->getMessage(), ['exception' => $exception]);
            return redirect()->back()->withError("An error occured while creating the door.");
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
        $door = Door::with('variants.miniPicture', 'variants.picture')->findOrFail($id);
        return view('admin.door.edit', compact('door'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
