<?php

namespace Simonbroekaert\LinkPicker\Http\Controllers;

use Illuminate\Database\Eloquent\Model;

class ApiController extends Controller
{
    public function models(string $model)
    {
        $model = str_replace('/', '\\', $model);

        return $model::get()
            ->map(function (Model $model) {
                return [
                    'key' => $model->getRouteKey(),
                    'label' => $model->link_picker_label ?? $model->name ?? $model->title ?? $model->getKey(),
                ];
            })
            ->values() ?? [];
    }
}
