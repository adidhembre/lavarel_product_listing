<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class brandnames extends Model
{
    protected $connection = 'mongodb1';
    protected $collection = 'brand_names';
}
