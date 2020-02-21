<?php

namespace App\Providers;

use App\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		Schema::defaultStringLength(191);

		view()->composer('*', function ($view) {
            $view->with('notifications', authenticated() ? Notification::where('to', myId())->get() : null);
        });
	}
}
