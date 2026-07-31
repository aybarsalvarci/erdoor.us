<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Certificates\CreateCertificateRequest;
use App\Http\Requests\Certificates\UpdateCertificateRequest;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $certificates = Certificate::paginate(19);
        return view('admin.certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.certificates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCertificateRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $fileName = 'certificate-' . time() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/certificates'), $fileName);

                $data['path'] = 'uploads/certificates/' . $fileName;
            }

            unset($data['file']);

            Certificate::create($data);

            return redirect()->route('admin.resources.certificates.index')->withSuccess("Certificate created successfully");
        }
        catch (\Exception $exception)
        {
            Log::error("Something went wrong: " . $exception->getMessage(), ['exception' => $exception]);
            return redirect()->back()->withInput()->withError("Something went wrong");
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
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificates.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCertificateRequest $request, string $id)
    {
        try {
            $certificate = Certificate::findOrFail($id);
            $data = $request->validated();

            if ($request->hasFile('file')) {
                $file = $request->file('file');

                if ($certificate->path && file_exists(public_path($certificate->path))) {
                    @unlink(public_path($certificate->path));
                }

                $fileName = 'certificate-' . time() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads/certificates'), $fileName);

                $data['path'] = 'uploads/certificates/' . $fileName;
            } else {
                $data['path'] = $certificate->path;
            }

            unset($data['file']);

            $certificate->update($data);

            return redirect()->route('admin.resources.certificates.index')->withSuccess("Certificate updated successfully");
        }
        catch (\Exception $exception)
        {
            Log::error("Something went wrong: " . $exception->getMessage(), ['exception' => $exception]);
            return redirect()->back()->withInput()->withError("Something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $certificate = Certificate::findOrFail($id);

            if ($certificate->path && file_exists(public_path($certificate->path))) {
                @unlink(public_path($certificate->path));
            }

            $certificate->delete();

            return redirect()->route('admin.resources.certificates.index')->withSuccess("Certificate deleted successfully");
        }
        catch (\Exception $exception)
        {
            Log::error("Something went wrong: " . $exception->getMessage(), ['exception' => $exception]);
            return redirect()->back()->withError("Something went wrong");
        }
    }
}
