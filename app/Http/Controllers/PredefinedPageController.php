<?php

namespace App\Http\Controllers;

use App\Enums\PredefinedPage;
use App\Models\Page;

class PredefinedPageController extends Controller
{
    public function home()
    {
        $page = Page::where('developer_id', PredefinedPage::PAGE_HOME)->firstOrFail();

        return view('static.home', [
            'page' => $page,
        ]);
    }

    public function contact()
    {
        $page = Page::where('developer_id', PredefinedPage::PAGE_CONTACT)->firstOrFail();

        return view('static.contact', [
            'page' => $page,
        ]);
    }

    public function cookie()
    {
        $page = Page::where('developer_id', PredefinedPage::PAGE_COOKIE)->firstOrFail();

        return view('static.cookie', [
            'page' => $page,
        ]);
    }

    public function privacy()
    {
        $page = Page::where('developer_id', PredefinedPage::PAGE_PRIVACY)->firstOrFail();

        return view('static.privacy', [
            'page' => $page,
        ]);
    }
}
