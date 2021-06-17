<?php

namespace App\Providers;

use App\Models\Sale;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);

//        $parentCategories = User::find(1);
//        dd('k');
//        dd($parentCategories);
//        $allCategories = Category::inRandomOrder()->limit(24)->get();*/
        /*$uncheckedOrderCount = Sale::where('status', 'unchecked')->count();

        View::share([
            'allCategories' => $allCategories,
            'uncheckedOrderCount' => $uncheckedOrderCount,
            'parentCategories' => $parentCategories
        ]);*/
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $allCategories = Category::with('categories')->where('real_depth', 0)->get();
        View::share([
            'allCategories' => $allCategories
        ]);
    }
}
