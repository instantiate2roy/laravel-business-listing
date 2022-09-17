<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'roles';
    protected $primaryKey = 'id';


    public function group()
    {
        return $this->belongsTo(Group::class, 'group_code', 'role_group');
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_number', 'role_rank');
    }
}
