<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
use App\Helpers\NumberFormatter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('shortNumber', function ($expression) {
        return "<?php echo \App\Helpers\NumberFormatterHelper::short($expression); ?>";
    });
    }
}
