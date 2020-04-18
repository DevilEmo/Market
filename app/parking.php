<?php

namespace App;

use App\Filters\ParkingFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class parking extends Model
{
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ParkingFilter($request))->filter($builder);
    } 
}
