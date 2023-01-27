<?php

namespace Simonbroekaert\LinkPicker;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Simonbroekaert\LinkPicker\LinkPicker;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('link-picker', __DIR__ . '/../dist/js/field.js');
            Nova::style('link-picker', __DIR__ . '/../dist/css/field.css');
        });

        $this->app->booted(function () {
            $this->routes();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Add singleton to the container
        $this->app->singleton('link-picker', function () {
            return new LinkPicker();
        });
    }

    protected function routes()
    {
        Route::middleware(['nova'])
            ->prefix('nova-link-picker')
            ->group(__DIR__ . '/../routes/api.php');
    }
}
