<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Whitecube\NovaFlexibleContent\Layouts\Collection as LayoutsCollection;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class LayoutBuilder extends Component
{
    /**
     * The blocks.
     *
     * @var \Illuminate\Support\Collection
     */
    public $blocks;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(LayoutsCollection $blocks)
    {
        $this->blocks = $this->prepareBlocks($blocks);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout-builder');
    }

    /**
     * Prepare the blocks.
     *
     * @param \Whitecube\NovaFlexibleContent\Layouts\Collection $blocks
     *
     * @return \Illuminate\Support\Collection
     */
    protected function prepareBlocks(Collection $blocks): Collection
    {
        $blocks = collect($blocks);

        $blocks = $blocks->map(function (Layout $block) use ($blocks) {
            $block->blade_component = "layout-builder.{$block->name()}";
            $block->data_index = $blocks->search($block);
            $block->data_type_index = $blocks->where(function (Layout $typeBlock) use ($block) {
                return $typeBlock->name() === $block->name();
            })->values()->search($block);

            return $block;
        });

        return $blocks;
    }
}
