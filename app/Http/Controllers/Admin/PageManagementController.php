<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\UpdateAboutUsRequest;
use App\Http\Requests\Pages\UpdateHomePageRequest;
use App\Http\Requests\Pages\UpdateWhyWpcRequest;
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

    public function manageWhyWPC()
    {
        $page = Page::findOrFail(2);
        return view('admin.pages.manage-why-wpc', compact('page'));
    }

    public function updateWhyWPC(UpdateWhyWpcRequest $request)
    {
        $page = Page::findOrFail(2);

        $translations = $request->validated('translations');

        foreach ($translations as $locale => &$data) {
            if (isset($data['content']['benefits_section']['cards'])) {
                $data['content']['benefits_section']['cards'] = array_values($data['content']['benefits_section']['cards']);
            }
        }

        unset($data);

        $page->update($translations);

        $page->touch();

        return redirect()->back()->with('success', 'Why WPC sayfası içerikleri başarıyla güncellendi.');
    }

    public function manageAboutUs()
    {
        $page = Page::findOrFail(3);
        return view('admin.pages.manage-about-page', compact('page'));
    }

    public function updateAboutUs(UpdateAboutUsRequest $request)
    {
        $page = Page::findOrFail(3);

        $translations = $request->validated('translations');

        foreach ($translations as $locale => &$data) {

            if (isset($data['content']['intro_section']['factories'])) {
                $data['content']['intro_section']['factories'] = array_values($data['content']['intro_section']['factories']);
            }

            if (isset($data['content']['global_section']['logos'])) {
                $data['content']['global_section']['logos'] = array_values($data['content']['global_section']['logos']);
            }

            if (isset($data['content']['global_section']['paragraphs'])) {
                $data['content']['global_section']['paragraphs'] = array_values($data['content']['global_section']['paragraphs']);
            }
        }

        unset($data);

        $page->update($translations);

        $page->touch();

        return redirect()->back()->with('success', 'About Us sayfası içerikleri başarıyla güncellendi.');
    }

}
