<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use HasFactory,Notifiable, HasRoles;

    protected $table = 'roles';
    protected $fillable = [
        'id',
        'name',
        'guard_name'
    ];
    protected $guard='admin';
    // public function role()
    // {
    //     return $this->hasOne(Restaurant::class, 'id', 'permission_id');
    // }
}
