<?php

namespace App\Providers;

use App\Models\Schedule;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


class RouteServiceProvider extends ServiceProvider
{
  /**
   * The path to the "home" route for your application.
   *
   * This is used by Laravel authentication to redirect users after login.
   *
   * @var string
   */
  public const HOME = '/home';

  /**
   * The controller namespace for the application.
   *
   * When present, controller route declarations will automatically be prefixed with this namespace.
   *
   * @var string|null
   */
  // protected $namespace = 'App\\Http\\Controllers';




  public static function redirectIfAuthenticated()
  {
    $user = Auth::user();

    if ($user->hasRole('admin')) {
      return 'home';
    }

    if ($user->hasRole('user')) {
      return route('user.home');
    }
  }



  /**
   * Define your route model bindings, pattern filters, etc.
   *
   * @return void
   */
  public function boot()
  {
    $this->configureRateLimiting();

    $this->routes(function () {
      Route::prefix('api')
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/api.php'));



      // initialize routes web.
      Route::middleware(['web', 'auth', 'role:user'])
        ->namespace($this->namespace)
        ->prefix('u')
        ->group(base_path('routes/web/user.php'));

      Route::middleware(['web', 'auth', 'role:admin'])
        ->namespace($this->namespace)
        ->prefix('admin')
        ->group(base_path('routes/web/admin.php'));

      Route::middleware('web')
        ->namespace($this->namespace)
        ->prefix('auth')
        ->group(base_path('routes/web/auth.php'));

      Route::middleware(['web'])
        ->namespace($this->namespace)
        ->group(base_path('routes/web/common.php'));

      Route::middleware('web')
        ->namespace($this->namespace)
        ->prefix('async')
        ->group(base_path('routes/web/async.php'));
    });


    Route::bind('schedule', function (string|int $param) {
      return Schedule::withoutGlobalScopes()
        ->active()
        ->where('slug', $param)
        ->orWhere('id', $param)
        ->firstOrFail();

    });
  }

  /**
   * Configure the rate limiters for the application.
   *
   * @return void
   */
  protected function configureRateLimiting()
  {
    RateLimiter::for('api', function (Request $request) {
      return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
    });
  }
}
