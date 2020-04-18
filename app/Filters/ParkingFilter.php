<?php

// ProductFilter.php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class ParkingFilter extends AbstractFilter
{
    protected $filters = [
        'ddate' => DateFilter::class,
    ];
}