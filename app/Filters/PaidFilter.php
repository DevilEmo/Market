<?php

// TypeFilter.php

namespace App\Filters;

class PaidFilter
{
    public function filter($builder, $value)
    {
        return $builder->join('payments','stallowners.id','=','payments.stallowner_id')
            ->select('stallowners.*','payments.duedate')
            ->where('payments.duedate','>=',date('Y-m-20',strtotime('-1month')))
            ->groupBy('payments.stallowner_id')->get();
    }
}