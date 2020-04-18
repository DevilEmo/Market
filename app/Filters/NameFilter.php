<?php

// TypeFilter.php

namespace App\Filters;

class NameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('name', 'like',$value.'%');
        // return $builder->join('payments','stallowners.id','=','payments.stallowner_id')
        //                 ->where('payments.created_at','like','%'.$value.'%')
        //                 ->first();
    }
}