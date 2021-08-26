<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait Confirmable
{
    const PENDING = 'pending';
    const CONFIRM = 'confirm';
    const REJECT = 'reject';


    public function scopeConfirm(Builder $builder): Builder
    {
        return $builder->withoutGlobalScopes()
        ->active()
        ->where('status', self::CONFIRM);
    }


    public function scopeReject(Builder $builder): Builder
    {
        return $builder->withoutGlobalScopes()
        ->active()
        ->where('status', self::REJECT);
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
        return $this->status === self::PENDING;
    }


    public function getIsConfirmAttribute(): bool
    {
        return $this->status === self::CONFIRM;
    }

    public function getIsRejectAttribute(): bool
    {
        return $this->status === self::REJECT;
    }

}
