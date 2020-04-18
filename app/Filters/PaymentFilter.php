<?php

// ProductFilter.php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class PaymentFilter extends AbstractFilter
{
    protected $filters = [
        'duedate' => DuedateFilter::class,
    ];
}