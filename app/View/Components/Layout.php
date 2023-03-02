<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * The layout object
     *
     * @var object
     */
    public object $layout;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public ?string $title = null, public ?object $seo = null)
    {
        $this->layout = (object) [
            'title' => $this->composeTitle(),
            'seo' => (object) [
                'title' => $this->composeTitle(),
                'description' => $this->seo?->description,
                'image' => $this->seo?->image ?? asset('logo/logo.svg'),
                'url' => request()->url(),
            ],
            'canonical' => $this->composeCanonicalLink(),
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout');
    }

    /**
     * Compose the title
     *
     * @return string
     */
    private function composeTitle(): string
    {
        return collect([
            $this->title ?? $this->seo?->title,
            setting('seo_title_suffix', Str::headline(config('app.name'))),
        ])->filter()->implode(' | ');
    }

    /**
     * Compose the canonical link.
     *
     * @return string
     */
    private function composeCanonicalLink(): string
    {
        // Return current url, but with host from config
        $host = config('app.url');
        $url = request()->url();

        return str_replace(request()->getSchemeAndHttpHost(), $host, $url);
    }
}
