<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

}
