<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            [
                '*/news',
                '*/news-detail',
                '*/orders/*',
            ],
            'App\Libraries\ViewComposers\NewsComposer' // class name
        );

        View::composer(
            [
                '*/orders/*',
            ],
            'App\Libraries\ViewComposers\StatusComposer' // class name
        );
    }
}
