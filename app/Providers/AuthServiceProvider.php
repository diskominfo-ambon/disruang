<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
      // 'App\Models\Model' => 'App\Policies\ModelPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot()
  {
    $this->registerPolicies();

    Gate::define('schedule.must.unique', function (?User $user, Request $request): bool {

      return Schedule::order([Schedule::PENDING, Schedule::CONFIRM])
        ->where([
          ['started_at', '<', $request->ended_at],
          ['ended_at', '>', $request->started_at],
          ['room_id', $request->room_id]
        ])
        ->where(function (Builder $builder) use ($request) {
          if ($request->filled('schedule_id')) {
            $builder->where('id', '!=', $request->schedule_id);
          }

          return $builder;
        })
        ->select('id')
        ->exists();
    });
  }
}
