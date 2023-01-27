<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Layouts\HomeHero;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class HomePreset extends Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */
    public function handle(Flexible $field)
    {
        $field->addLayout(HomeHero::class);
    }
}
