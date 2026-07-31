<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $messages = ContactMessage::when($request->filled('search'), function ($query) use ($request) {
            $query->where('full_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
        })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->paginate($request->per_page ?? 10);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(int $id)
    {
        $message = ContactMessage::findOrFail($id);

        $message->status = 'read';
        $message->save();

        return view('admin.contact-messages.show', compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = ContactMessage::findOrFail($id);
        try {
            $message->delete();
            return redirect()->back()->with('success', 'Message has been deleted');
        }
        catch (\Exception $exception){
            {
                Log::error("An error occured while deleting the message: {$exception->getMessage()}", ['exception' => $exception]);
                return redirect()->back()->with('error',"An error occured while deleting the message.");
            }
        }
    }
}
