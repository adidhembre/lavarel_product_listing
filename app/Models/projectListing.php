<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class projectListing extends Model
{
    protected $connection = 'mongodb1';
    protected $collection = 'product_listing';
}
