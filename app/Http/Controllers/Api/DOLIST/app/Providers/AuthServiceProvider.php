<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
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

        /**
         * 
          *Replicating claims as headers is deprecated and will removed from v4.0. 
          *Please manually set the header if you need it replicated.
          *oauthバージョンの問題で以上のエラーが出ないために、下の判断を付けます 
         */
        if (config('app.debug')) {
            error_reporting(E_ALL & ~E_USER_DEPRECATED);
        } else {
            error_reporting(0);
        }
        //
    }
}
