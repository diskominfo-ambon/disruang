<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

trait HasEmployee
{


  /**
   * He is employee attribute.
   *
   * @return boolean
   */
  public function getIsEmployeeAttribute(): bool
  {
    return Str::of($this->origin)->isNotEmpty() &&
      Str::of($this->origin_job_title)->isNotEmpty();
  }

  /**
   * Query all employee.
   *
   * @param \Illuminate\Database\Eloquent\Builder $builder
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeEmployee(Builder $builder): Builder
  {
    return $builder->whereNotNull(['origin', 'origin_job_title']);
  }

  /**
   * Query not all employee.
   *
   * @param \Illuminate\Database\Eloquent\Builder $builder
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeNotEmployee(Builder $builder): Builder
  {
    return $builder->whereNull(['origin', 'origin_job_title']);
  }

}
