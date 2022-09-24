<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class Business extends Model
{
    use HasFactory;
    protected $table = 'businesses';
    protected $primaryKey = 'id';

    public function user()
    {
        $this->hasOne(User::class, 'id', 'biz_owner');
    }

    public function getStatusAttribute()
    {
        $val = $this->biz_status;
        $lookup = Lookup::where([['lk_scope', 'BUSINESS_STATUS'], ['lk_key', $this->biz_status]])->first();
        if ($lookup) {
            $val = $lookup->lk_short_description;
        }

        return $val;
    }

    public function getCanDeleteAttribute()
    {
        $val = 0;
        if (Gate::allows('delete', $this)) {
            $val = '1';
        }
        return $val;
    }

    public function getCanEditAttribute()
    {
        $val = 0;
        if (Gate::allows('update', $this)) {
            $val = 1;
        }
        return $val;
    }
}
