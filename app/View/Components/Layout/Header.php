<?php

namespace App\View\Components\Layout;

use App\Enums\PredefinedPage;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?Page $contactPage = null,
    ) {
        $this->contactPage = Page::where('developer_id', PredefinedPage::PAGE_CONTACT)->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $brandName = setting('general_brand_name', Str::headline(config('app.name')));

        return view('components.layout.header', compact('brandName'));
    }
}
