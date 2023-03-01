<?php

namespace App\View\Components\LayoutBuilder;

use App\Models\PredefinedPlan;
use Illuminate\View\Component;

class Plans extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public object $block)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $predefinedPlans = PredefinedPlan::whereIn('id', $this->block->predefinedPlans ?? [])
            ->ordered()
            ->get();

        return view('components.layout-builder.plans', compact('predefinedPlans'));
    }
}
