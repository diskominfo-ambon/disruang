<?php

namespace App\Support\Eloquent;

use Illuminate\Support\Str;

trait HasNatureASN
{
  /**
   * He is employee ASN
   *
   * @return boolean
   */
  public function asn(): bool
  {
    return Str::of($this->origin)->trim()->isNotEmpty() &&
      Str::of($this->origin_job_title)->trim()->isNotEmpty();
  }
}
