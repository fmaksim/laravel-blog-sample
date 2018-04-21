<?php

namespace App\Providers;

use App\Entities\Category;
use App\Services\PostService;
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
        view()->composer('blog.partials.sidebar', function ($view) {
            $view->with("popularPost", PostService::getPopular());
            $view->with("featuredPosts", PostService::getFeatured());
            $view->with("recentPosts", PostService::getRecent());
            $view->with("categories", Category::getCategories());
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
