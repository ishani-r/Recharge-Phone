<?php

namespace App\Package;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{

    protected $table = 'premia';
    public $fillable = ['name', 'six_month', 'three_month', 'one_month', 'try_days', 'save', 'status'];
}
