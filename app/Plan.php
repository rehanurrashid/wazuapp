<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Plan extends Model
{
	use SoftDeletes;

    public function users(){
    	return $this->belongsTo(User::class,'user_plans','user_id','id');
    }
    
}
