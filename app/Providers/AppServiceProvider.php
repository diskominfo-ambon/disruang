<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

use Carbon\Carbon;
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
    Blade::stringable(fn (Carbon $carbon) => $carbon->isoFormat('LLL'));

    $this->loadViewsFrom(__DIR__.'/../resources/views/web', 'web');
    $this->loadViewsFrom(__DIR__.'/../resources/views/exports', 'exports');
  }
}
