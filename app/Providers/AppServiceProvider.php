<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::user(); 
            $fotoProfil = $user && $user->profil ? asset('storage/' . $user->profil->foto) : asset('../assets/images/profile/user-1.jpg');

            $view->with('fotoProfil', $fotoProfil);
        });
    }
}
