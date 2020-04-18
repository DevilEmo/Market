<?php

namespace App;

use App\Filters\PaymentFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class payment extends Model
{
    public function stallowner(){
        return $this->belongsTo('App\stallowner');
    }

    public function scopeFilter(Builder $builder, $request)
    {
        return (new PaymentFilter($request))->filter($builder);
    }
}
