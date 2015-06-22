<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Whenever navbar partial is loaded, provide the required data
        view()->composer('partials.navbar', function($view){
            $data = array(
                'user' => Auth::user(),
                'isAdmin' => checkAdminOwner()
            );
            $view->with($data);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
