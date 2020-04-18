<?php

// TypeFilter.php

namespace App\Filters;

class DateFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('ddate', 'like','%'.$value.'%');
    }
}