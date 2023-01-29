<?php

namespace App\Nova\Flexible\Layouts;

use Simonbroekaert\Youtube\Nova\Fields\Youtube;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class Video extends Layout
{
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
}
