<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
    //     view()->composer('*', function ($view) 
    //     {
    //         if (!in_array($view->getName(), ['auth.login', 'layouts.app'])) {
    //             $userLogin = Auth::id();
    //             $permission_0 = User::where('id', $userLogin)->with('roles.permissions')->get();
    //             $pMenu = [];
    //             foreach($permission_0 as $p0){
    //                 foreach($p0->roles as $d){
    //                     foreach($d->permissions as $p){
    //                         $pMenu[] =  $p->id;
    //                     }
    //                 }
    //             }
    //             $query = Menu::with(["sub_menu" => function($q) use ($pMenu){
    //                 $q->whereIn('permission_id', $pMenu);
    //             }])->whereIn('permission_id', $pMenu)->get();

    //             $view->with('Menu', $query );
    //         }
    //     });
    }
}