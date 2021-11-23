<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class projects extends Model
{
    protected $connection = 'mongodb1';
    protected $collection = 'project';
}