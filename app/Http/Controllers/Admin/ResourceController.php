<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
