<?php

namespace App\Nova\Flexible\Presets;

use App\Nova\Flexible\Layouts\Article;
use App\Nova\Flexible\Layouts\ArticleWithMedia;
use App\Nova\Flexible\Layouts\Form;
use App\Nova\Flexible\Layouts\Gallery;
use App\Nova\Flexible\Layouts\Highlight;
use App\Nova\Flexible\Layouts\HomeHero;
use App\Nova\Flexible\Layouts\Images;
use App\Nova\Flexible\Layouts\Plans;
use App\Nova\Flexible\Layouts\Quote;
use App\Nova\Flexible\Layouts\Video;
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
        $field->addLayout(Article::class);
        $field->addLayout(ArticleWithMedia::class);
        $field->addLayout(Highlight::class);
        $field->addLayout(Gallery::class);
        $field->addLayout(Images::class);
        $field->addLayout(Plans::class);
        $field->addLayout(Quote::class);
        $field->addLayout(Video::class);
        $field->addLayout(Form::class);
    }

    public static function fake(?int $amountOfBlocks = null, $asJsonString = true): array|string
    {
        if ($amountOfBlocks === null) {
            $amountOfBlocks = fake()->numberBetween(1, 10);
        }

        $blocks = [];

        if ($amountOfBlocks === 0) {
            return $blocks;
        }

        $blocks[] = HomeHero::fake(asJsonString: false);

        for ($i = 0; $i < $amountOfBlocks; $i++) {
            $blocks[] = fake()->randomElement([
                Article::fake(asJsonString: false),
                Article::fake(asJsonString: false),
                ArticleWithMedia::fake(asJsonString: false),
                ArticleWithMedia::fake(asJsonString: false),
                ArticleWithMedia::fake(asJsonString: false),
                ArticleWithMedia::fake(asJsonString: false),
                Highlight::fake(asJsonString: false),
                Highlight::fake(asJsonString: false),
                Gallery::fake(asJsonString: false),
                Images::fake(asJsonString: false),
                Plans::fake(asJsonString: false),
                Quote::fake(asJsonString: false),
                Quote::fake(asJsonString: false),
                Video::fake(asJsonString: false),
                Form::fake(asJsonString: false),
            ]);
        }

        return $asJsonString ? json_encode($blocks) : $blocks;
    }
}
