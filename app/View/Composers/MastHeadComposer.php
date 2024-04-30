<?php

namespace App\View\Composers;

use Illuminate\View\View;

class MastHeadComposer
{
    public function compose(View $view)
    {
        $mastHeadContent = [
            'mastHeadBg' => null,
            'mastHeadTitle' => null,
            'mastHeadSubTitle' => null,
            'mastHeadFavicon' => '/assets/favicon.ico',
        ];

        if (request()->routeIs('home') || request()->routeIs('post.show')) {
            $mastHeadContent['mastHeadBg'] = '/assets/imgs/home-bg.jpg';
            $mastHeadContent['mastHeadTitle'] = 'IlluminateInsights';
            $mastHeadContent['mastHeadSubTitle'] = 'Immerse in illuminating journeys and valuable insights.';
        }

        if (request()->routeIs('about')) {
            $mastHeadContent['mastHeadBg'] = '/assets/imgs/about-bg.jpg';
            $mastHeadContent['mastHeadTitle'] = 'About Me';
            $mastHeadContent['mastHeadSubTitle'] = 'This is what I do.';
        }

        if (request()->routeIs('contact')) {
            $mastHeadContent['mastHeadBg'] = '/assets/imgs/contact-bg.jpg';
            $mastHeadContent['mastHeadTitle'] = 'Contact Me';
            $mastHeadContent['mastHeadSubTitle'] = 'Have questions? I have answers.';
        }

        $view->with($mastHeadContent);
    }
}
