<?php

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Carbon\Carbon;


// Global functions.

if (!function_exists('str')) {
  function str(string $str): Stringable
  {
    return Str::of($str);
  }
}


if (!function_exists('carbon')) {
  function carbon($datetime)
  {

    return Carbon::parse($datetime)
      ->timezone(env('APP_TIMEZONE'));
  }
}
