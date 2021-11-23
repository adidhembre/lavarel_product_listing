<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class temp extends Model
{
    protected $connection = 'mongodb1';
    //protected $collection = 'product_listing';
    protected $collection = 'temp';
}