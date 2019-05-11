<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->blade();
    }

    private function blade(): void
    {
        $path = $this->app['config']->get('view.compiled');

        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }
}
