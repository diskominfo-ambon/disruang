<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
  use HasFactory;


  protected $table = 'room_has_participants';

  protected $guarded = [
    'id'
  ];


  public function scopeAsn(Builder $builder): Builder
  {
    return $builder
      ->whereNotNull('origin')
      ->whereNotNull('origin_job_title');
  }


  public function scopeGuest(Builder $builder): Builder
  {
    return $builder
      ->whereNull('origin')
      ->whereNull('origin_job_title');
  }

}
