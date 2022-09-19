<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Pivot
{
    //
    use HasFactory;
    protected $table = 'user_roles';
    protected $primaryKey = 'id';

    public function getUserNameAttribute()
    {
        return User::Find($this->ur_userid)->name;
    }

    public function getRoleNameAttribute()
    {
        return Role::where('role_code', $this->ur_rolecode)->first()->role_name;
    }
}
