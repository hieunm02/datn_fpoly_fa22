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
        // single view bind
        // View::composer(
        //     '*', // view name
        //     'App\Libraries\ViewComposers\NewsComposer' // composer class name
        // );

        // multiple view bind
        View::composer(
            [
                '*/news',
                '*/news-detail',
            ],
            'App\Libraries\ViewComposers\NewsComposer' // class name
        );
    }
}
