<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Layouts\Hero;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Preset;

class DefaultPreset extends Preset
{
    /**
     * Execute the preset configuration
     *
     * @return void
     */
    public function handle(Flexible $field)
    {
        $field->addLayout(Hero::class);
    }
}
