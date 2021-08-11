<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;


use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Blade::stringable(fn (Carbon $carbon) => $carbon->isoFormat('LL'));

    $this->loadViewsFrom(resource_path('views/web'), 'web');
    $this->loadViewsFrom(resource_path('views/web/auth'), 'auth');
  }
}
