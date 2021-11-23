<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class brand extends Model
{
    protected $connection = 'mongodb1';
    protected $collection = 'brand';
}
