<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{

  /**
   * The root template that's loaded on the first page visit.
   *
   * @see https://inertiajs.com/server-side-setup#root-template
   * @var string
   */
  protected $rootView = 'inertia';

  /**
   * Defines the props that are shared by default.
   *
   * @see https://inertiajs.com/shared-data
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function share(Request $request)
  {
    return array_merge(parent::share($request), [
      'isAuthenticated' => fn () => $request?->user() || false,
      'auth.user' => fn () => $request?->user()?->only(['id', 'name', 'email']),
      'flash' => [
        'message' => fn () => $request->session()->get('message')
      ]
    ]);
  }
}
