<?php

namespace App;

use Laratrust\Models\LaratrustRole;
use App\User;

class Role extends LaratrustRole
{
    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class, 'role_user','user_id','role_id'); 
    }
}
