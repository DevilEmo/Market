<?php

// TypeFilter.php

namespace App\Filters;

class EmailFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('email', $value);
    }
}