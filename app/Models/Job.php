<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'jobs';


    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'job_customer');
    }


    public function business()
    {
        return  $this->belongsTo(Business::class, 'biz_code', 'job_business');
    }
}
