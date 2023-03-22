<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::if('routeis', function ($route) {
            return request()->routeIs($route);
        });
        
        Blade::directive('route', function($expression){
            return "<?php echo route($expression)  ?>";
        });

    }
}
