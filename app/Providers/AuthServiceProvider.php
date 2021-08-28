<?php

namespace App\Providers;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Order;
use App\Models\Parameter;
use App\Models\Product;
use App\Models\Store;
use App\Policies\AttributePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ParameterPolicy;
use App\Policies\ProductPolicy;
use App\Policies\StorePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
        Store::class => StorePolicy::class,
        Category::class => CategoryPolicy::class,
        Attribute::class => AttributePolicy::class,
        Parameter::class => ParameterPolicy::class,
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}
