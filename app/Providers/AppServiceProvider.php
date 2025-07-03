<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Paginator::useBootstrapFive();
    //* View Composer
    view()->composer('layouts.FrontendLayout', function ($view) {
      $view->with('categories', Category::where('status', true)->latest()->get())
      ->with('cartCount', Cart::where(function ($q)  {
          return $q->where('ip', request()->ip())->orWhere('user_id', auth()?->user()?->id);
        })->count());
    });
  }
}
