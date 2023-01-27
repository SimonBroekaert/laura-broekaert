<?php

namespace Simonbroekaert\LinkPicker\Nova\Fields;

use Laravel\Nova\Fields\Field;

class LinkPicker extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'link-picker';

    /**
     * Resolve the field's value.
     *
     * @param  mixed  $resource
     * @param  string|null  $attribute
     * @return void
     */
    public function resolve($resource, $attribute = null)
    {
        $this->withMeta([
            'routes' => app('link-picker')->fetchAvailableRoutes(),
        ]);

        parent::resolve($resource, $attribute);
    }

    /**
     * Resolve the field's value for display.
     *
     * @param  mixed  $resource
     * @param  string|null  $attribute
     * @return void
     */
    public function resolveForDisplay($resource, $attribute = null)
    {
        parent::resolveForDisplay($resource, $attribute);

        $this->withMeta([
            'link' => app('link-picker')->route($this->value),
        ]);
    }
}
