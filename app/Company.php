<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'address', 'website', 'email', 'avatar'];
}
