<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'groups';
    protected $primaryKey = 'id';

    /**
     * define zero/one to many relationship between the user group and user role
     */
    public function role()
    {
        return $this->hasMany(Role::class, 'role_group', 'group_code');
    }
}
