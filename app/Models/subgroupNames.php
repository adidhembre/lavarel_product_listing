<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class subgroupNames extends Model
{
    protected $connection = 'mongodb1';
    protected $collection = 'subgroup_names';
}
