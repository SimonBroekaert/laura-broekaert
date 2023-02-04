<?php

namespace App\Providers;

use App\Nova\Dashboards\Main;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use KABBOUCHI\LogsTool\LogsTool;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Outl1ne\NovaSettings\NovaSettings;

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

        $this->registerSettings();
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
            new NovaSettings(),
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
            return $this->displayUsing(
                function ($value) {
                    return $value->isoFormat('dddd, LL');
                }
            );
        });

        Field::macro('datetimeFormat', function () {
            /** @var \Laravel\Nova\Fields\Field $this */
            return $this->displayUsing(
                function ($value) {
                    $date = $value->isoFormat('dddd, LL');
                    $time = $value->isoFormat('LT');
                    $glue = 'at';

                    return "{$date} {$glue} {$time}";
                }
            );
        });

        Field::macro('hideFromRelationshipIndex', function () {
            if (NovaRequest::createFrom(request())->viaRelationship()) {
                /** @var \Laravel\Nova\Fields\Field $this */
                return $this->hideFromIndex();
            }

            return $this;
        });

        Field::macro('autofillFrom', function ($field) {
            if (! NovaRequest::createFrom(request())->viaRelationship()) {
                return $this;
            }

            if (! NovaRequest::createFrom(request())->isCreateOrAttachRequest()) {
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
        Gate::define('viewNova', fn () => true);
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
     * Register the Nova settings.
     *
     * @return void
     */
    protected function registerSettings()
    {
        NovaSettings::addSettingsFields([
            Text::make('Brand Name', 'general_brand_name')
                ->rules('required', 'max:255'),
        ], [], 'General');

        NovaSettings::addSettingsFields([
            Text::make('Title suffix', 'seo_title_suffix')
                ->rules('required', 'max:255'),
        ], [], 'SEO');

        NovaSettings::addSettingsFields([
            Email::make('Email', 'contact_email')
                ->rules('required', 'max:255'),
            Text::make('Phone', 'contact_phone')
                ->rules('required', 'max:255'),
        ], [], 'Contact');

        NovaSettings::addSettingsFields([
            Text::make('Facebook', 'socials_facebook'),
            Text::make('Instagram', 'socials_instagram'),
            Text::make('YouTube', 'socials_youtube'),
            Text::make('TikTok', 'socials_tiktok'),
            Text::make('Twitter', 'socials_twitter'),
        ], [], 'Socials');
    }
}
