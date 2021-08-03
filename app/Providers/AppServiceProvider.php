<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;


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

    $this->loadViewsFrom([
      resource_path('views/web'),
      resource_path('views/web/sections')
    ], 'web');


    Response::macro('payload', function ($payload) {
      return Response::json([
        'status' => true,
        'message' => 'Successfully',
        'code' => 200,
        'payload' => $payload,
      ]);
    });

    Response::macro('failed', function ($code = 401) {
      return Response::json([
        'status' => false,
        'message' => 'Failed',
        'code' => $code,
      ]);
    });
  }
}
