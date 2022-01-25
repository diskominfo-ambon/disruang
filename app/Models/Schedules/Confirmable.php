<?php

namespace App\Models\Schedules;

use Illuminate\Database\Eloquent\Builder;

trait Confirmable
{
    /**
     * Status is pending.
     *
     * @var string
     * @const
     */
    public static $PENDING = 'pending';

    /**
     * Status confirmed.
     *
     * @var string
     * @const
     */
    public static $CONFIRM = 'confirm';

    /**
     * Status rejected.
     *
     * @var string
     * @const
     */
    public static $REJECT = 'reject';


    public static $REVIEW = 'review';


    public function scopeConfirm(Builder $builder): Builder
    {
        return $builder->withoutGlobalScopes()
            ->active()
            ->where('status', self::$CONFIRM);
    }


    public function scopeReject(Builder $builder): Builder
    {
        return $builder->withoutGlobalScopes()
            ->active()
            ->where('status', self::$REJECT);
    }

    public function scopeReview(Builder $builder): Builder
    {
        return $builder->withoutGlobalScopes()
            ->active()
            ->where('status', self::$REVIEW);
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
        return $this->status === self::$PENDING;
    }


    public function getIsConfirmAttribute(): bool
    {
        return $this->status === self::$CONFIRM;
    }

    public function getIsRejectAttribute(): bool
    {
        return $this->status === self::$REJECT;
    }

    public function geIsReviewAttribute(): bool
    {
        return $this->status === self::$REVIEW;
    }

}
