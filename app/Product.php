<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\ProductRating;
use App\Category;
use App\User; 
use DB;

class Product extends Model
{
	use SoftDeletes;

	protected $guard = [];

	public function user(){
        return $this->belongsTo(User::class,'user_id','id')->with('profile');
    }

    public function scans(){
        return $this->belongsToMany(User::class,'history')->distinct();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function setSlugAttribute($slug)
    {
        $slug = Str::slug( $slug );
        $slugs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'");

        if ($slugs->count() === 0) {
            $this->attributes['slug'] = $slug;
        }
        else{   
            // Get the last matching slug
            $lastSlug = $slugs->orderBy('slug', 'desc')->first()->slug;
        
            // Strip the number off of the last slug, if any
            $lastSlugNumber = intval(str_replace($slug . '-', '', $lastSlug));
        
            // Increment/append the counter and return the slug we generated
            $this->attributes['slug'] = $slug . '-' . ($lastSlugNumber + 1);
        }
    }

    public function rating()
    {
        return $this->hasMany(ProductRating::class, 'product_id','id')->with('user');
    }

}
