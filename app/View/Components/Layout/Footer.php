<?php

namespace App\View\Components\Layout;

use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $brandName = setting('general_brand_name', 'Laura Broekaert');
        $email = setting('contact_email');
        $phone = setting('contact_phone');
        $socials = collect([
            'facebook' => setting('socials_facebook'),
            'instagram' => setting('socials_instagram'),
            'twitter' => setting('socials_twitter'),
            'youtube' => setting('socials_youtube'),
            'tiktok' => setting('socials_tiktok'),
        ])->filter();

        return view('components.layout.footer', compact([
            'brandName',
            'email',
            'phone',
            'socials',
        ]));
    }
}
