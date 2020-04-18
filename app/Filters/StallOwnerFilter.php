<?php

// ProductFilter.php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class StallOwnerFilter extends AbstractFilter
{
    protected $filters = [
        'name' => NameFilter::class,
        'paid' => PaidFilter::class,
        'unpaid' => UnpaidFilter::class,
    ];
}