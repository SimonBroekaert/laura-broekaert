<?php

namespace Simonbroekaert\LinkPicker\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ApiController extends Controller
{
    public function models(string $model)
    {
        $model = str_replace('/', '\\', $model);

        if (method_exists($model, 'linkPicker')) {
            return $model::linkPicker()
                ->map(function (Model $model) {
                    return [
                        'key' => $model->getRouteKey(),
                        'label' => $model->link_picker_label ?? $model->name ?? $model->title ?? $model->getKey(),
                    ];
                })
                ->values() ?? [];
        }

        return $model::query()
            ->when(method_exists($model, 'scopeLinkPicker'), function (Builder $query) {
                $query->linkPicker();
            })
            ->get()
            ->map(function (Model $model) {
                return [
                    'key' => $model->getRouteKey(),
                    'label' => $model->link_picker_label ?? $model->name ?? $model->title ?? $model->getKey(),
                ];
            })
            ->values() ?? [];
    }
}
