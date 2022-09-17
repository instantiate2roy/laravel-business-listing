<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rank extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ranks';
    protected $primaryKey = 'id';

    public  function role()
    {
        return $this->hasMany(Role::class, 'role_rank', 'rank_number');
    }
}
