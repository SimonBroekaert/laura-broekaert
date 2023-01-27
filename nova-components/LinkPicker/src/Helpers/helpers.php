<?php

use Simonbroekaert\LinkPicker\LinkPicker;

if (! function_exists('linkPicker')) {
    function linkPicker(): LinkPicker
    {
        return app('link-picker');
    }
}
