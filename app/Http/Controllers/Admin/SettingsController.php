<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateSettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(UpdateSettingsRequest $request)
    {
        $settings = Setting::first();

        try {
            $validatedData = $request->validated();

            $uploadPath = public_path('uploads/settings');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if ($request->hasFile('logo')) {
                $logoFile = $request->file('logo');
                $logoName = 'logo-' . time() . '.' . $logoFile->getClientOriginalExtension();
                $logoFile->move($uploadPath, $logoName);
                $validatedData['logo'] = 'uploads/settings/' . $logoName;
            } else {
                $validatedData['logo'] = $settings->logo ?? null;
            }

            if ($request->hasFile('favicon')) {
                $faviconFile = $request->file('favicon');
                $faviconName = 'favicon-' . time() . '.' . $faviconFile->getClientOriginalExtension();
                $faviconFile->move($uploadPath, $faviconName);
                $validatedData['favicon'] = 'uploads/settings/' . $faviconName;
            } else {
                $validatedData['favicon'] = $settings->favicon ?? null;
            }

            $settings->update($validatedData);

            return redirect()->back()->with('success', 'Settings updated successfully');
        }
        catch (\Exception $exception)
        {
            Log::error("An error occured while settings updating: " . $exception->getMessage(), ['exception' => $exception]);
            return redirect()->back()->withInput()->with('error', 'An error occured while updating settings');
        }
    }
}
