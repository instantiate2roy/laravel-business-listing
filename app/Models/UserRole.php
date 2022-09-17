<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Pivot
{
    //
    use SoftDeletes;
    protected $table = 'user_roles';
    protected $primaryKey = 'id';
}
