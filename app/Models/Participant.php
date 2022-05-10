<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Concerns\MustVerifySignature;
use App\Models\Concerns\HasEmployee;

class Participant extends Model
{
  use HasFactory, HasEmployee, MustVerifySignature;


  protected $table = 'room_has_participants';

  protected $guarded = [
    'id'
  ];

  /**
   * Relationship: One Participant has belongs to schedules.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function schedule(): BelongsTo
  {
    return $this->belongsTo(Schedule::class);
  }

  public function getIsEmployeeAttribute()
  {
    return !is_null($this->employee);
  }

  public function employee()
  {
    return $this->belongsTo(Employee::class, 'employee_id');
  }

  public function scopePresent(Builder $builder): Builder {
    return $builder->where('is_present', true);
  }

  public function getIsNotPresentAttribute(): bool
  {
    return $this->is_present === 0;
  }

}
