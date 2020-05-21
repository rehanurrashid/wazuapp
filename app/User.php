<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\PasswordResetNotification;
use Laravel\Passport\HasApiTokens;
use App\UserProfile;
use App\UserPlan;
use App\Product;
use App\Role;
use App\Plan;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,SoftDeletes,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','status_id',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->hasOne(UserProfile::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function history(){
        return $this->belongsToMany(Product::class, 'history', 'user_id', 'product_id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_user','user_id','role_id');
    }

    public static function scopeVendor($query){
        return $query->where('role','=','vendor');
    }

    public static function scopeCustomer($query){
        return $query->where('role','=','customer');
    }

    public function scans(){
        return $this->belongsToMany(Product::class,'history')->with(['category'])->withCount('scans')->distinct();
    }

    public function plan(){
        return $this->belongsTo(Plan::class, 'user_plans','user_id','plan_id');
    }
}

