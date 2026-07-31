<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\UpdateHomePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageManagementController extends Controller
{
    public function manageHomePage()
    {
        $page = Page::findOrFail(1);
        return view('admin.pages.manage-homepage', compact('page'));
    }

    public function updateHomePage(UpdateHomePageRequest $request)
    {
        $page = Page::findOrFail(1);

        $translations = $request->validated('translations');

        foreach ($translations as $locale => &$data) {

            if (isset($data['content']['benefits_section'])) {
                $data['content']['benefits_section'] = array_values($data['content']['benefits_section']);
            }

            if (isset($data['content']['comparison_section']['features'])) {
                $data['content']['comparison_section']['features'] = array_values($data['content']['comparison_section']['features']);
            }
        }

        unset($data);

        $page->update($translations);

        return redirect()->back()->with('success', 'Anasayfa içerikleri başarıyla güncellendi.');
    }
}
