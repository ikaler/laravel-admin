<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /** @var string $apiNamespace */
    protected $apiNamespace ='App\Http\Controllers\Api';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {

            $defaultVersion = config('app.api_latest', 1);

            Route::prefix('api/v1')
                ->middleware(['api', 'api_version:v1', 'check_api_key'])
                ->namespace("{$this->apiNamespace}\V1")
                ->group(base_path('routes/api_v1.php'));

            /**
             * In case version is missing in the url then set to default
             */
            Route::prefix('api')
                ->middleware(["api", "api_version:v{$defaultVersion}", "check_api_key"])
                ->namespace("{$this->apiNamespace}\V{$defaultVersion}")
                ->group(base_path("routes/api_v{$defaultVersion}.php"));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
