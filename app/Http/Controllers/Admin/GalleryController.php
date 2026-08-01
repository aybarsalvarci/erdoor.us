<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallery\StoreGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryImages = Gallery::with('media')->paginate(10);
        return view('admin.gallery.index', compact('galleryImages'));
    }

    public function store(StoreGalleryRequest $request)
    {
        try {
            $data = $request->validated();

            Gallery::create($data);

            return redirect()->back()->with('success', 'Görsel galeriye başarıyla eklendi.');
        } catch (\Exception $exception) {
            \Log::error("Galeriye görsel eklenirken hata oluştu: " . $exception->getMessage(), ['exception' => $exception]);

            return redirect()->back()->withInput()->with('error', 'Görsel eklenirken bir hata oluştu.');
        }
    }


    public function destroy(int $id)
    {
        $image = Gallery::findOrFail($id);
        try {
            $image->delete();
            return redirect()->back()->with('success', 'Görsel galeriye başarıyla silindi.');
        } catch (\Exception $exception) {
            \Log::error("Galeri görseli silinirken hata oluştu: " . $exception->getMessage(), ['exception' => $exception]);

            return redirect()->back()->withInput()->with('error', 'Galeri görseli silinirken hata oluştu.');
        }
    }
}
