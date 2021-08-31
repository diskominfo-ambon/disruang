<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait MustVerifySignature
{
    public function getHasSignatureAttribute(): bool
    {
      return Str::of($this->signature)->isNotEmpty()
        && Storage::disk('public')->exists($this->signature);
    }
}
