<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Newsletter\CreateNewsletterRequest;
use App\Http\Requests\Newsletter\UpdateNewsletterRequest;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsletters = Newsletter::paginate(10);
        return view('admin.newsletter.index', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.newsletter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNewsletterRequest $request)
    {
        try {
            Newsletter::create($request->validated());
            return redirect()->route('admin.newsletter.index')->with('success', 'Newsletter created successfully.');
        }
        catch (\Exception $exception)
        {
            Log::error("An error occured while creating newsletter: " . $exception->getMessage(), ['exception' => $exception]);
            return back()->with('error', "An error occured while creating newsletter.");
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('admin.newsletter.edit', compact('newsletter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsletterRequest $request, string $id)
    {
        $newsletter = Newsletter::findOrFail($id);
        try {
            $newsletter->update($request->validated());
            return redirect()->route('admin.newsletter.index')->with('success', 'Newsletter updated successfully.');
        }
        catch (\Exception $exception)
        {
            Log::error("An error occured while updating newsletter: " . $exception->getMessage(), ['exception' => $exception]);
            return back()->with('error', "An error occured while updating newsletter.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $newsletter = Newsletter::findOrFail($id);

        try {
            $newsletter->delete();
            return redirect()->route('admin.newsletter.index')->with('success', 'Newsletter deleted successfully.');
        }
        catch (\Exception $exception)
        {
            Log::error("An error occured while deleting newsletter: " . $exception->getMessage(), ['exception' => $exception]);
            return back()->with('error', "An error occured while deleting newsletter.");
        }
    }
}
