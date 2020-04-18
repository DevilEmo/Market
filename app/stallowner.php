<?php

namespace App;

use App\Filters\StallOwnerFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class stallowner extends Model
{
    public function scopeFilter(Builder $builder, $request)
    {
        return (new StallOwnerFilter($request))->filter($builder);
    }
    public function payments(){
        return $this->hasMany('App\payment');
    }
    // protected $casts = [
    //     'duedate' => 'date:m-d-y',
    //     'created_at' => 'date:Y-m-d'
    // ];
}
