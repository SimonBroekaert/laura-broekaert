<?php

namespace App\Nova\Flexible\Layouts;

use App\Nova\Flexible\Layouts\Traits\Fakable;
use Simonbroekaert\Youtube\Nova\Fields\Youtube;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Video extends Layout
{
    use Fakable;

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'video';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Video';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Youtube::make('Url (ID)', 'video_id')
                ->required()
                ->rules('required'),
        ];
    }

    public static function fakeDefinition(): array
    {
        return [
            'video_id' => fake()->randomElement([
                'H3DYbjt0X2o',
                'vhi-ImQ9A7o',
                '0DPZ9b9ZZr4&t=58s',
            ]),
        ];
    }
}
