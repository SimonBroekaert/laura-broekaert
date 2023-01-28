<?php

namespace App\Http\Controllers;

use App\Enums\PredefinedPage;
use App\Models\Page;

class HomeController extends Controller
{
    public function __invoke()
    {
        $page = Page::where('developer_id', PredefinedPage::PAGE_HOME)->firstOrFail();

        return view('static.home', [
            'page' => $page,
        ]);
    }
}
