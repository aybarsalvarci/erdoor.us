<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaPicker\StoreFileRequest;
use App\Http\Requests\MediaPicker\StoreFromUrlRequest;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    public function fetchMedia()
    {
        $medias = Media::latest()->simplePaginate(12);
        return response()->json([
            'medias' => $medias,
        ]);
    }

    public function updateAlt(Request $request)
    {
        $media = Media::findOrFail($request->id);
        $media->alt_text = $request->alt_text;
        $media->save();

        return response(status: 200);
    }

    public function storeUrl(StoreFromUrlRequest $request)
    {
        try {
            Media::create([
                'path' => $request->image_url,
                'type' => 'external'
            ]);

            return response()->json([
                'success' => true,
            ]);

        } catch (\Exception $exception) {
            Log::error("Image upload failed: " . $exception->getMessage(), ['exception' => $exception]);

            return response()->json([
                'success' => false,
            ], 500);
        }
    }


    public function storeFile(StoreFileRequest $request)
    {
        try {
            $files = $request->file('files');

            if (!$files) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lütfen en az bir dosya seçin.'
                ], 400);
            }

            foreach ($files as $file) {
                $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('media', $fileName, 'public');

                Media::create([
                    'path'     => $path,
                    'type'     => 'internal',
                    'alt_text' => $request->alt_text ?? null,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Dosyalar başarıyla yüklendi.'
            ]);

        } catch (\Exception $exception) {
            Log::error("File upload failed: " . $exception->getMessage(), ['exception' => $exception]);

            return response()->json([
                'success' => false,
                'message' => 'Dosya yüklenirken bir sunucu hatası oluştu.'
            ], 500);
        }
    }
}
