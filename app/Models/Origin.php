<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    use HasFactory;


    public function employees()
    {
        return $this->hasMany(
            Employee::class,
            'origin_id',
            'id'
        );
    }

    public function users()
    {
        return $this->hasMany(
            User::class,
            'origin_id',
            'id'
        );
    }

    public function schedules()
    {
        return $this->belongsToMany(
            Schedule::class,
            'schedule_has_origins',
            'origin_id',
            'schedule_id'
        );
    }


}
