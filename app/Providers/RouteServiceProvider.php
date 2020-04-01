<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {
	/**
	 * This namespace is applied to your controller routes.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @return void
	 */
	public function boot() {
		//

		parent::boot();
	}

	/**
	 * Define the routes for the application.
	 *
	 * @return void
	 */
	public function map() {
		$this->mapApiRoutes();

		$this->mapWebRoutes();

		$this->mapAdminRoutes();

        $this->mapAgentRoutes();

        $this->mapOwnerRoutes();

        $this->mapRenterRoutes();
	}

	/**
	 * Define the "web" routes for the application.
	 *
	 * These routes all receive session state, CSRF protection, etc.
	 *
	 * @return void
	 */
	protected function mapWebRoutes() {
		Route::middleware('web')
			->namespace($this->namespace)
			->group(base_path('routes/web.php'));
	}

	/**
	 * Define the "api" routes for the application.
	 *
	 * These routes are typically stateless.
	 *
	 * @return void
	 */
	protected function mapApiRoutes() {
		Route::prefix('api')
			->middleware('api')
			->namespace($this->namespace)
			->group(base_path('routes/api.php'));
	}

	/**
	 * Define the "admin" routes for the application.
	 *
	 * These routes are typically stateless.
	 *
	 * @return void
	 */
	protected function mapAdminRoutes() {
		Route::prefix('admin')
			->middleware(['web', 'auth:admin'])
			->namespace($this->namespace)
			->group(base_path('routes/admin.php'));
	}

	/**
	 * Define the "agent" routes for the application.
	 *
	 * These routes are typically stateless.
	 *
	 * @return void
	 */
	protected function mapAgentRoutes() {
		Route::prefix('agent')
			->middleware(['web', 'auth:agent', 'isActive'])
			->namespace($this->namespace)
			->group(base_path('routes/agent.php'));
	}

    /**
     * Define the "owner" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapOwnerRoutes() {
        Route::prefix('owner')
             ->middleware(['web', 'auth:owner', 'isActive'])
             ->namespace($this->namespace)
             ->group(base_path('routes/owner.php'));
    }

    /**
     * Define the "renter" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapRenterRoutes() {
        Route::prefix('renter')
             ->middleware(['web', 'auth:renter', 'isActive'])
             ->namespace($this->namespace)
             ->group(base_path('routes/renter.php'));
    }
}
