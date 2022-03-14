<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasFactory, Notifiable, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'username',
    'name',
    'email',
    'password',
    'phone_number',
    'origin_id',
    'origin_job'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];


  public function schedules(): HasMany
  {
    return $this->hasMany(Schedule::class);
  }

  /**
   * Query all user without this current 'user'.
   *
   * @param \Illuminate\Database\Eloquent\Builder $builder
   * @return Illuminate\Database\Eloquent\Builder
   */
  public function scopeWithoutCurrentUser(Builder $builder): Builder
  {
    return $builder->where('id', '!=', Auth::user()->id);
  }


  public function origin()
  {
    return $this->belongsTo(Origin::class);
  }

}
