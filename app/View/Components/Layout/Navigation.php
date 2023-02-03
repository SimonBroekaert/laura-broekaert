<?php

namespace App\View\Components\Layout;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;

class Navigation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $menuKey = 'main',
        public array $ulAttributes = [],
        public array $liAttributes = [],
        public array $lastLiAttributes = [],
        public array $aAttributes = [],
    ) {
        $this->menuKey = $menuKey;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $menu = Menu::where('developer_id', $this->menuKey)->first();
        $ulAttributesBag = new ComponentAttributeBag($this->ulAttributes);
        $liAttributesBag = new ComponentAttributeBag($this->liAttributes);
        $aAttributesBag = new ComponentAttributeBag($this->aAttributes);

        return view('components.layout.navigation', compact(
            'menu',
            'ulAttributesBag',
            'liAttributesBag',
            'aAttributesBag',
        ));
    }

    /**
     * Check if the menu item is active.
     *
     * @param \App\Models\MenuItem $item
     *
     * @return bool
     */
    public function isActive(MenuItem $item): bool
    {
        if ($item->route_name === null) {
            return false;
        }

        return Str::startsWith(request()->route()->getName(), Str::before($item->route_name, '.'));
    }
}
