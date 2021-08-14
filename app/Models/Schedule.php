<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
  use HasFactory;


  // schedule status.
  const PENDING = 'pending';
  const CONFIRM = 'confirm';
  const REJECT = 'reject';


  protected $table = 'room_has_schedules';

  protected $guarded = [
    'id'
  ];

  protected $casts = [
    'started_at' => 'datetime',
    'ended_at' => 'datetime',
    'is_active' => 'boolean'
  ];


  /**
   * Bootied method
   *
   * @override
   * @return void
   */
  protected static function booted()
  {
    static::addGlobalScope(
      Schedule::PENDING,
      fn (Builder $builder) => $builder->active()->where('status', Schedule::PENDING)
    );

    static::saving(function (Schedule $schedule) {
      $schedule->slug = str($schedule->title)->lower()->slug();
    });
  }


  /**
   * Route bind key name
   *
   * @override
   * @return void
   */
  public function getRouteKeyName()
  {
    return 'slug';
  }


  public function scopeConfirm(Builder $builder): Builder
  {
    return $builder->withoutGlobalScopes()
      ->active()
      ->where('status', Schedule::CONFIRM);
  }


  public function scopeReject(Builder $builder): Builder
  {
    return $builder->withoutGlobalScopes()
      ->active()
      ->where('status', Schedule::REJECT);
  }


  public function scopeActive(Builder $builder): Builder
  {
    return $builder->where('is_active', 1);
  }


  public function scopeOrder(Builder $builder, string|array $order): Builder
  {
    return $builder
      ->withoutGlobalScopes()
      ->active()
      ->where(function (Builder $builder) use ($order) {
        if (is_array($order)) {
          $builder->whereIn('status', $order);
        }

        if (is_string($order)) {
          $builder->where('status', $order);
        }

        return $builder;
      });
  }



  public function getIsPendingAttribute(): bool
  {
    return $this->status === Schedule::PENDING;
  }


  public function getIsConfirmAttribute(): bool
  {
    return $this->status === Schedule::CONFIRM;
  }

  public function getIsRejectAttribute(): bool
  {
    return $this->status === Schedule::REJECT;
  }


  // relationships join.

  public function participants(): HasMany
  {
    return $this->hasMany(Participant::class);
  }


  public function room(): BelongsTo
  {
    return $this->belongsTo(Room::class);
  }


  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

}
