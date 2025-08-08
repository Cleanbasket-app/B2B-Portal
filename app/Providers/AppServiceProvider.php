<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use App\Models\Client;
use App\Models\Location;
use App\Models\Order;
use App\Models\Schedule;
use App\Models\User;
use App\Observers\ActivityLogObserver;

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
        App::setLocale(config('app.locale'));

        Client::observe(ActivityLogObserver::class);
        Location::observe(ActivityLogObserver::class);
        Order::observe(ActivityLogObserver::class);
        Schedule::observe(ActivityLogObserver::class);
        User::observe(ActivityLogObserver::class);
    }
}
