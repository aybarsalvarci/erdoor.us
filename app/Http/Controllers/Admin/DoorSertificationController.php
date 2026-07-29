<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sertificate\StoreCertificateRequest;
use App\Http\Requests\Sertificate\UpdateTextRequest;
use App\Models\Door;
use App\Models\DoorSertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoorSertificationController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function updateText(UpdateTextRequest $request, string $id)
    {
        $door = Door::findOrFail($id);
        try{
            $door->update($request->validated());
            return redirect()->back()->with([
                'success' => 'Sertification text successfully updated.',
                'tab' => 'certs'
            ]);
        }
        catch (\Exception $exception){
            return redirect()->back()->with([
                'error' => 'An error occured while updating Sertification text.',
                'tab' => 'certs'
            ]);
        }
    }

    public function storeSertificate(StoreCertificateRequest $request, int $id)
    {
        $door = Door::findOrFail($id);

        try {
            $door->sertificates()->create($request->validated());
            return redirect()->back()->with([
                'success' => 'Sertificate successfully updated.',
                'tab' => 'certs'
            ]);
        }
        catch (\Exception $exception){
            Log::error("An error occured while updating Sertificate: " . $exception->getMessage(), ['exception' => $exception]);
            return redirect()->back()->with([
                'error' => 'An error occured while updating Sertificate.',
                'tab' => 'certs'
            ]);
        }
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
        $certificate = DoorSertificate::findOrFail($id);
        try {
            $certificate->delete();
            return redirect()->back()->with([
                'success' => 'Sertificate successfully deleted.',
                'tab' => 'certs'
            ]);
        }
        catch (\Exception $exception){
            return redirect()->back()->with([
                'error' => 'An error occured while deleting Sertificate.',
                'tab' => 'certs'
            ]);
        }
    }
}
