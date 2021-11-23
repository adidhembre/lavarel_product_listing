<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class groupNames extends Model
{
    protected $connection = 'mongodb1';
    protected $collection = 'group_names';
}
