<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';
    protected $fillable = [
         'id',
         'country_id',
         'state',
     ];

    public function restaurent()
    {
        return $this->hasOne(Country::class,'id','country_id');
    }
}
