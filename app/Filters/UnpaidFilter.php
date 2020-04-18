<?php

// TypeFilter.php

namespace App\Filters;

class UnpaidFilter
{
    public function filter($builder, $value)
    {
        return $builder->join('payments','stallowners.id','=','payments.stallowner_id')
        ->select('stallowners.*','payments.duedate')
        ->whereDoesntHave('payments',function ($query)
        {
            $query->where('payments.duedate',date('Y-m-20',strtotime('-2month')));
        })
        //->where('active',1)
        ->groupBy('payments.stallowner_id')->get();
    }
}