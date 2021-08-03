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

  protected $table = 'room_has_schedules';

  protected $guarded = [
    'id'
  ];

  protected $casts = [
    'started_at' => 'datetime',
    'ended_at' => 'datetime',
    'is_active' => 'boolean'
  ];




  protected static function booted()
  {
    static::addGlobalScope(
      'pending',
      fn (Builder $builder) => $builder->active()->where('status', 'pending')
    );
  }


  public function scopeConfirm(Builder $builder): Builder
  {
    return $builder->withoutGlobalScopes()
      ->active()
      ->where('status', 'confirm');
  }


  public function scopeReject(Builder $builder): Builder
  {
    return $builder->withoutGlobalScopes()
      ->active()
      ->where('status', 'reject');
  }


  public function scopeActive(Builder $builder): Builder
  {
    return $builder->where('is_active', 1);
  }


  public function scopeOrder(Builder $builder, string $order): Builder
  {
    return $builder
      ->withoutGlobalScopes()
      ->active()
      ->where('status', $order);
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
