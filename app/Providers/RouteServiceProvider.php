<?php

namespace App\Providers;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Order;
use App\Models\Parameter;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
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

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        parent::boot();

        ########### restore model after delete for make policy #######
        Route::bind('store', function ($id) {
            return Store::withTrashed()->findOrFail($id);
        });

        Route::bind('category', function ($id) {
            return Category::withTrashed()->findOrFail($id);
        });

        Route::bind('attribute', function ($id) {
            return Attribute::withTrashed()->findOrFail($id);
        });

        Route::bind('parameter', function ($id) {
            return Parameter::withTrashed()->findOrFail($id);
        });

        Route::bind('product', function ($id) {
            return Product::withTrashed()->findOrFail($id);
        });

        Route::bind('order', function ($id) {
            return Order::withTrashed()->findOrFail($id);
        });

        Route::bind('user', function ($id) {
            return User::withTrashed()->findOrFail($id);
        });
        ##################### end #######################

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

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
