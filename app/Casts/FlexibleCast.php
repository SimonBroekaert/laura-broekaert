<?php

namespace App\Casts;

use Whitecube\NovaFlexibleContent\Value\FlexibleCast as BaseFlexibleCast;

class FlexibleCast extends BaseFlexibleCast
{
    protected $layouts = [
        // Layout Builder
        'home-hero' => \App\Nova\Flexible\Layouts\HomeHero::class,
        'hero' => \App\Nova\Flexible\Layouts\Hero::class,
        'article' => \App\Nova\Flexible\Layouts\Article::class,
        'article-with-media' => \App\Nova\Flexible\Layouts\ArticleWithMedia::class,
        'gallery' => \App\Nova\Flexible\Layouts\Gallery::class,
        'images' => \App\Nova\Flexible\Layouts\Images::class,
        'video' => \App\Nova\Flexible\Layouts\Video::class,
        'highlight' => \App\Nova\Flexible\Layouts\Highlight::class,
        'quote' => \App\Nova\Flexible\Layouts\Quote::class,
        'plans' => \App\Nova\Flexible\Layouts\Plans::class,
        'form' => \App\Nova\Flexible\Layouts\Form::class,
        // Other
        'plan-bundle' => \App\Nova\Flexible\Layouts\PlanBundle::class,
    ];
}
