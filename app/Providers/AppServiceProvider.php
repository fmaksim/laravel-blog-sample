<?php

namespace App\Providers;

use App\Entities\Category;
use App\Entities\Post;
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
            $view->with("popularPost", Post::getPopularPosts());
            $view->with("featuredPosts", Post::getFeaturedPosts());
            $view->with("recentPosts", Post::getRecentPosts());
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
