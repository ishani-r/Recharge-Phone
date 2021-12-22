<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premium extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'six_months',
        'three_months',
        'one_months',
        'try_days',
        'save',
    ];
}
