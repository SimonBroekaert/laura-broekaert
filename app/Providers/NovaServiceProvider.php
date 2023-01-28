<?php

namespace App\Providers;

use App\Nova\Dashboards\Main;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use KABBOUCHI\LogsTool\LogsTool;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::withBreadcrumbs();

        Nova::serving(function (ServingNova $event) {
            app()->setLocale('en');
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new Main(),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            (new LogsTool())
                ->canSee(function ($request) {
                    return $request->user()->is_developer;
                }),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 99999;
        });

        Field::macro('dateFormat', function () {
            /** @var \Laravel\Nova\Fields\Field $this */
            return $this->displayUsing(function ($value) {
                return $value->isoFormat('dddd, LL');
            });
        });

        Field::macro('datetimeFormat', function () {
            /** @var \Laravel\Nova\Fields\Field $this */
            return $this->displayUsing(function ($value) {
                $date = $value->isoFormat('dddd, LL');
                $time = $value->isoFormat('LT');
                $glue = 'at';

                return "{$date} {$glue} {$time}";
            });
        });

        Field::macro('hideFromRelationshipIndex', function () {
            if (NovaRequest::createFrom(request())->viaRelationship()) {
                /** @var \Laravel\Nova\Fields\Field $this */
                return $this->hideFromIndex();
            }

            return $this;
        });

        Field::macro('autofillFrom', function ($field) {
            if (!NovaRequest::createFrom(request())->viaRelationship()) {
                return $this;
            }

            if (!NovaRequest::createFrom(request())->isCreateOrAttachRequest()) {
                return $this;
            }

            $fieldStack = explode('.', $field);
            $relation = array_shift($fieldStack);
            $subRelations = array_slice($fieldStack, 0, -1);
            $attribute = end($fieldStack);

            $viaResource = NovaRequest::createFrom(request())->viaResource();

            if (Str::camel(basename($viaResource::$model)) !== $relation) {
                return $this;
            }

            $model = NovaRequest::createFrom(request())->findParentModel();

            if (is_null($model)) {
                return $this;
            }

            foreach ($subRelations as $subRelation) {
                $model = $model->{$subRelation} ?? null;

                if (is_null($model)) {
                    return $this;
                }
            }

            $value = $model->{$attribute} ?? null;

            if (is_null($value)) {
                return $this;
            }

            /** @var \Laravel\Nova\Fields\Field $this */
            return $this->withMeta([
                'value' => $value,
            ]);
        });
    }
}
