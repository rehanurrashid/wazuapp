<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
	public $timestamps = true;
	
    protected $fillable = [
        'created_at', 'updated_at', 'user_id','plan_id',
    ];
}
