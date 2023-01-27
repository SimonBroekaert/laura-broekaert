<?php

namespace App\Casts;

use Whitecube\NovaFlexibleContent\Value\FlexibleCast as BaseFlexibleCast;

class FlexibleCast extends BaseFlexibleCast
{
    protected $layouts = [
        'home-hero' => \App\Nova\Flexible\Layouts\HomeHero::class,
        'hero' => \App\Nova\Flexible\Layouts\Hero::class,
    ];
}
