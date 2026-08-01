<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\UpdateTechnicalCertificatesRequest;
use App\Http\Requests\Pages\UpdateWarranyPageRequest;
use App\Http\Requests\Resources\UpdateDigitalCatalogPageRequest;
use App\Http\Requests\Resources\UpdateFireResistancePageRequest;
use App\Http\Requests\Resources\UpdateGalleryPageRequest;
use App\Http\Requests\Resources\UpdateInstallationPageRequest;
use App\Models\ResourcePage;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function installationPage()
    {
        $page = ResourcePage::whereTranslation('slug', 'installation')->first();
        return view('admin.resources.installation-page', compact('page'));
    }

    public function updateInstallationPage(UpdateInstallationPageRequest $request)
    {
        $page = ResourcePage::whereTranslation('slug', 'installation')->first();

        $page->update([
            'icon' => $request->icon,
            'image_id' => $request->image_id,
        ]);

        foreach ($request->translations as $locale => $data) {

            if (isset($data['page_content']['notes']['steps']) && is_array($data['page_content']['notes']['steps'])) {
                $data['page_content']['notes']['steps'] = array_values($data['page_content']['notes']['steps']);
            } else {
                $data['page_content']['notes']['steps'] = [];
            }

            $page->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title' => $data['title'],
                    'slug' => $data['slug'],
                    'link_text' => $data['link_text'],
                    'description' => $data['description'],
                    'page_content' => $data['page_content'],
                ]
            );
        }

        return redirect()->back()->with('success', 'Installation sayfası başarıyla güncellendi.');
    }

    public function fireResistenceTest()
    {
        $page = ResourcePage::whereTranslation('slug', 'fire-resistance-test')->first();
        return view('admin.resources.fire-resistence-test', compact('page'));
    }

    public function updateFireResistenceTest(UpdateFireResistancePageRequest $request)
    {
        $page = ResourcePage::whereTranslation('slug', 'fire-resistance-test')->first();

        $page->update([
            'icon' => $request->icon,
            'image_id' => $request->image_id,
        ]);

        foreach ($request->translations as $locale => $data) {

            if (isset($data['page_content']['notes']['steps']) && is_array($data['page_content']['notes']['steps'])) {
                $data['page_content']['notes']['steps'] = array_values($data['page_content']['notes']['steps']);
            } else {
                $data['page_content']['notes']['steps'] = [];
            }

            $page->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title' => $data['title'],
                    'slug' => $data['slug'],
                    'link_text' => $data['link_text'],
                    'description' => $data['description'],
                    'page_content' => $data['page_content'],
                ]
            );
        }

        return redirect()->back()->with('success', 'Installation sayfası başarıyla güncellendi.');
    }

    public function warrantyPage()
    {
        $page = ResourcePage::whereTranslation('slug', 'warranty-and-return-policy')->first();
        return view('admin.resources.warranty', compact('page'));
    }

    public function updateWarrantyPage(UpdateWarranyPageRequest $request)
    {
        $page = ResourcePage::whereTranslation('slug', 'warranty-and-return-policy')->first();

        $pageData = [
            'icon' => $request->icon,
            'image_id' => $request->image_id,
        ];

        foreach (['en', 'es'] as $locale) {
            if ($request->has("translations.$locale")) {
                $data = $request->input("translations.$locale");

                if ($request->hasFile("translations.$locale.pdf_file")) {
                    $file = $request->file("translations.$locale.pdf_file");

                    $fileName = 'warranty-' . $locale . '-' . time() . '.' . $file->getClientOriginalExtension();

                    $file->move(public_path('uploads/pdfs'), $fileName);

                    $data['page_content']['pdf_url'] = 'uploads/pdfs/' . $fileName;
                }
                $pageData[$locale] = $data;
            }
        }

        $page->update($pageData);

        return redirect()->back()->with('success', 'Warranty & Return Policy sayfası başarıyla güncellendi.');
    }

    public function technicalCertificatesPage()
    {
        $page = ResourcePage::whereTranslation('slug', 'technical-and-certificates')->first();
        return view('admin.resources.technical-certificates', compact('page'));
    }

    public function updateTechnicalCertificatesPage(UpdateTechnicalCertificatesRequest $request)
    {
        $page = ResourcePage::whereTranslation('slug', 'technical-and-certificates')->firstOrFail();

        $pageData = [
            'icon' => $request->icon,
            'image_id' => $request->image_id,
        ];

        foreach (['en', 'es'] as $locale) {
            if ($request->has("translations.$locale")) {
                $data = $request->input("translations.$locale");

                $pageData[$locale] = $data;
            }
        }

        $page->update($pageData);

        return redirect()->back()->with('success', 'Technical & Certificates sayfası başarıyla güncellendi.');
    }

    public function galleryPage()
    {
        $page = ResourcePage::whereTranslation('slug', 'gallery')->first();
        return view('admin.resources.gallery', compact('page'));
    }

    public function updateGalleryPage(UpdateGalleryPageRequest $request)
    {
        $page = ResourcePage::whereTranslation('slug', 'gallery')->firstOrFail();

        $pageData = [
            'icon' => $request->icon,
            'image_id' => $request->image_id,
        ];

        foreach (['en', 'es'] as $locale) {
            if ($request->has("translations.$locale")) {
                $data = $request->input("translations.$locale");

                $pageData[$locale] = $data;
            }
        }

        $page->update($pageData);

        return redirect()->back()->with('success', 'Galeri sayfası başarıyla güncellendi.');
    }

    public function catalogPage(){
        $page = ResourcePage::whereTranslation('slug', 'digital-catalog')->first();
        return view('admin.resources.digital-catalog', compact('page'));
    }

    public function updateCatalogPage(UpdateDigitalCatalogPageRequest $request)
    {
        try {
            $page = ResourcePage::whereTranslation('slug', 'digital-catalog', 'en')->firstOrFail();

            $pageData = [
                'icon' => $request->icon,
                'image_id' => $request->image_id,
            ];

            foreach (['en', 'es'] as $locale) {
                if ($request->has("translations.$locale")) {
                    $data = $request->input("translations.$locale");

                    if ($request->hasFile("translations.$locale.pdf_file")) {
                        $file = $request->file("translations.$locale.pdf_file");

                        $fileName = 'catalog-' . $locale . '-' . time() . '.' . $file->getClientOriginalExtension();

                        $file->move(public_path('uploads/pdfs'), $fileName);

                        $data['page_content']['pdf_url'] = 'uploads/pdfs/' . $fileName;
                    }

                    $pageData[$locale] = $data;
                }
            }

            $page->update($pageData);

            return redirect()->back()->with('success', 'Digital Catalog sayfası başarıyla güncellendi.');

        } catch (\Exception $exception) {
            \Log::error("Digital Catalog sayfası güncellenirken hata oluştu: " . $exception->getMessage());
            return redirect()->back()->withInput()->with('error', 'Sayfa güncellenirken bir hata oluştu. Lütfen tekrar deneyin.');
        }
    }
}
