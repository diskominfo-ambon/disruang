<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Concerns\Confirmable;

class Schedule extends Model
{
  use HasFactory, Confirmable;


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
    // global scope status query is pending.
    static::addGlobalScope(
      Schedule::$PENDING,
      fn (Builder $builder) => $builder->active()->where('status', self::$PENDING)
    );

    static::saving(function (Schedule $schedule) {
      $schedule->slug = str($schedule->title)
            ->lower()
            ->slug();
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


  public function scopeActive(Builder $builder): Builder
  {
    return $builder->where('is_active', 1);
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
