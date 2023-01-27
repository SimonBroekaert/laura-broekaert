<?php

namespace Simonbroekaert\LinkPicker;

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class LinkPicker
{
    /**
     * Build a route from the given data.
     *
     * @param array|string|null $data
     *
     * @return string|null
     */
    public function route(array|string|null $data): ?string
    {
        if ($data === null) {
            return null;
        }

        // Make sure the data is an array
        if (! is_array($data)) {
            $data = json_decode($data, true);
        }

        $route = $data['route'];

        if ($route === '' || $route === null) {
            return null;
        }

        $parameters = collect($data['parameters'] ?? [])
            ->mapWithKeys(function ($parameter) {
                return [$parameter['name'] => $parameter['value']];
            })
            ->toArray();

        if (Str::startsWith($route, 'external.')) {
            return match ($route) {
                'external.url' => $parameters['url'],
                'external.mailto' => "mailto:{$parameters['email']}",
                'external.tel' => "tel:{$parameters['phone']}",
                default => null,
            };
        }

        return route(
            $route,
            $parameters,
        );
    }

    /**
     * Build a button from the given data.
     *
     * @param array|string|null $data
     * @param string|null $label
     *
     * @return object|null
     */
    public function button(array|string|null $data, ?string $label = null): ?object
    {
        $link = $this->route($data);
        if ($link === null) {
            return null;
        }

        return (object) [
            'link' => $link,
            'label' => $label ?? $link,
            'target' => $this->isExternalRoute($data) ? '_blank' : '_self',
        ];
    }


    /**
     * Check if the route is external.
     *
     * @param array|string|null $data
     *
     * @return bool
     */
    public function isExternalRoute(array|string|null $data): bool
    {
        if ($data === null) {
            return false;
        }

        // Make sure the data is an array
        if (! is_array($data)) {
            $data = json_decode($data, true);
        }

        $route = $data['route'];

        if ($route === '' || $route === null) {
            return false;
        }

        return Str::startsWith($route, 'external.');
    }

    /**
     * Fetch all the available routes from the application.
     *
     * @return array
     */
    public function fetchAvailableRoutes(): array
    {
        return collect(Route::getRoutes()->getRoutesByName())
            ->filter(function (RoutingRoute $route) {
                if (! collect($route->methods())->contains('GET')) {
                    return false;
                }

                $isLinkPickerRoute = $route->wheres['link-picker'] ?? false;
                if (! $isLinkPickerRoute) {
                    return false;
                }

                return true;
            })
            ->map(function (RoutingRoute $route) {
                $signatureParameters = collect($route->signatureParameters());

                return [
                    'label' => Str::of($route->getName())
                        ->explode('.')
                        ->map(fn (string $part) => Str::title($part))
                        ->implode(' > '),
                    'name' => $route->getName(),
                    'uri' => $route->uri(),
                    'parameters' => collect($route->parameterNames())
                        ->map(function (string $parameter) use ($route, $signatureParameters) {
                            $model = null;
                            $type = 'string';
                            $isOptional = true;

                            if ($signatureParameters->contains('name', $parameter)) {
                                /** @var \ReflectionParameter $reflectionParameter */
                                $reflectionParameter = $signatureParameters->firstWhere('name', $parameter);

                                $model = $reflectionParameter?->getType()?->getName();
                                $type = $model ? 'model' : 'string';
                                $isOptional = $reflectionParameter?->allowsNull() ?? true;
                            }

                            return [
                                'name' => $parameter,
                                'label' => Str::title($parameter),
                                'type' => $type,
                                'model' => $model,
                                'isOptional' => $isOptional,
                            ];
                        }),
                ];
            })
            ->sortBy('name')
            ->toArray();
    }
}
