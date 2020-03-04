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
//        if(\File::exists(public_path('/blog/wp-load.php'))) {
//            require_once (public_path('/blog/wp-load.php'));
//        }
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

//        wp_enqueue_style('frontend-styles', URL::asset('css/frontend.css'), ['dependencies'], false);
//        wp_enqueue_script('frontend-scripts', URL::asset('js/frontend.js'), ['dependencies'], false, true);
	}
}
