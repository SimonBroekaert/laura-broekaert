<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Layouts\Article;
use App\Nova\Flexible\Layouts\ArticleWithMedia;
use App\Nova\Flexible\Layouts\Hero;
use App\Nova\Flexible\Layouts\Highlight;
use App\Nova\Flexible\Layouts\Images;
use App\Nova\Flexible\Layouts\Quote;
use App\Nova\Flexible\Layouts\Video;
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
        $field->addLayout(Article::class);
        $field->addLayout(ArticleWithMedia::class);
        $field->addLayout(Highlight::class);
        $field->addLayout(Images::class);
        $field->addLayout(Plans::class);
        $field->addLayout(Quote::class);
        $field->addLayout(Video::class);
    }
}
