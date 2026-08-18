<?php

namespace App\Providers;

use App\Events\UserRegister;
use App\Listeners\WelcomeMailListener;
use App\Services\PaymentService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrapFive();

        $this->app->singleton("payment", function($app){
            return new PaymentService();
        });
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
           UserRegister::class,
           WelcomeMailListener::class
        );
    }
}
