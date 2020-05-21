<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserProfile extends Model
{
	protected $fillable = [
        'user_id', 'address', 'city','country','phone','photo'
    ];

    protected $guard = [];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
