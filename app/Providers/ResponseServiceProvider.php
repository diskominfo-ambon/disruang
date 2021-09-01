<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
      //
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    Response::macro('payload', function ($payload) {
      return Response::json([
        'status' => true,
        'message' => 'Successfully',
        'code' => 200,
        'payload' => $payload,
      ]);
    });

    Response::macro('failed', function ($code = 401, $message = 'Failed') {
      return Response::json(
        data: [
          'status' => false,
          'message' => $message,
          'code' => $code,
        ],
        status: $code
      );
    });

    Response::macro('success', function (bool $reload = true, ?string $message = null, ?string $route = null, $code = 200) {

      if ($reload || !empty($route)) {
        request()->session()
          ->flash('message', $message);
      }

      if (!empty($route)) {
        $reload = false;
      }

      return Response::json(
        data: [
          'status' => true,
          'code' => 200,
          'message' => $message,
          'payload' => [
            'ajax' => [
              'reload' => $reload,
              'route' => $route
            ]
          ]
        ],
        status: $code
      );
    });
  }
}
