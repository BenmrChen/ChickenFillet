<?php

namespace App\Providers;

use App\ChickenFilletShop;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy', // 這個是原來就被隱藏的，但放下面那個似乎不能用
//        ChickenFilletShop::class => ChickenFilletShopPolicy::class, // 官方文件也是這樣寫
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
