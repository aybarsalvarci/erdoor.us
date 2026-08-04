<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailSubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subscribers = EmailSubscriber::when($request->filled('search'), function ($query) use ($request) {
            $query->where('email', 'like', '%' . $request->search . '%');
        })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate($request->per_page ?? 10);

        return view('admin.email-subscriber.index', compact('subscribers'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscriber = EmailSubscriber::findOrFail($id);

        try {
            $subscriber->delete();
            return redirect()->back()->with('success', 'Subscriber deleted successfully');
        }
        catch (\Exception $exception)
        {
            Log::error("Subscriber deleted error: " . $exception->getMessage(), ['exception' => $exception]);
            return redirect()->back()->with('error', 'An error occurred while deleting the subscriber');
        }
    }
}
