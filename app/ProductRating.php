<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ProductRating extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id')->with('profile');
    }

    // public function scopeRate($query)
    // {
    //     return $query->havingRaw('AVG(product_raings.rate) BETWEEN ? AND ?', [4, 5]);
    // }

}
