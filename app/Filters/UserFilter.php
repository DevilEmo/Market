<?php

// ProductFilter.php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{
    protected $filters = [
        'name' => NameFilter::class,
        'email' => EmailFilter::class,
        'type' => TypeFilter::class,
    ];
}