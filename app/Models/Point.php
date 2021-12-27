<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $table = 'points';
    protected $fillable = [
         'user_id',
         'total_post',
         'total_point',
         'user_send_request',
         'request_point',
     ];
}
