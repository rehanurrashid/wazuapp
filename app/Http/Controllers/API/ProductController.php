<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductRating;
use App\Product;
use App\Recipe;
use Validator;
use DB;

class ProductController extends Controller
{
    public function show(Request $request){

        if($request->keyword == '' && $request->slug == ''){
            return response(['error' => 'Atleast one word(keyword/slug) is required for searching...!'], 200);
        }

        if(!empty($request->slug)){

            $product = Product::with(['category','user','rating'])->where('slug', $request->slug)->first();
            

            if(!empty($product)){

                $product['latest_products'] = Product::orderBy('id', 'desc')->take(5)->get();

                if(empty($product['latest_products'])){
                    $product['latest_products'] = 'No Latest Products Found!';
                }

                
                $search_terms = explode(",", $product->tags);
    
                $product['related_products'] = Product::where(function ($q) use ($search_terms) {
                  foreach ($search_terms as $value) {
                    $q->orWhere('tags', 'like', '%'.$value.'%');
                  }
                })->with(['rating'])->where('slug', '<>' , $product->slug)->get();

                if(empty($product['related_products'][0])){
                    $product['related_products'] = 'No Related Products Found!';
                }
                else{
                    foreach ($product['related_products'] as $row) {

                        $rate = $row->rating()->avg('rate');
                        $rate = number_format((float)$rate, 1, '.', '');
                        $row->avg_rate = $rate;

                    }
                }

                $product['related_recipes'] = Recipe::where(function ($q) use ($search_terms) {
                  foreach ($search_terms as $value) {
                    $q->orWhere('ingredients', 'like', '%'.$value.'%');
                  }
                })->get();

                if(empty($product['related_recipes'][0])){
                    $product['related_recipes'] = 'No Related Recipes Found!';
                }
                
                auth()->user()->products()->attach($product->id);

                $rate = $product->rating()->avg('rate');
                $rate = number_format((float)$rate, 1, '.', '');
                $product->avg_rate = $rate;

                return response(['product' => $product], 200);
            }
            else{
                $product['product'] = 'No Product Found!';
                $product['latest_products'] = Product::orderBy('id', 'desc')->take(5)->get();
                return response(['error' => $product], 200);
            }
        }
        else if(!empty($request->keyword)){

            $searchValues = preg_split('/\s /', $request->keyword, -1, PREG_SPLIT_NO_EMPTY);
            $search_terms = explode(" ", $searchValues[0]);
            // $products = Searchy::products('title')->query($searchValues[0])->get();
            $products = Product::where(function ($q) use ($search_terms) {
              foreach ($search_terms as $value) {
                $q->orWhere('title', 'like', '%'.$value.'%')
                    ->orWhere('tags', 'like', '%'.$value.'%');
              }
            })->get();

            $props = ['title'];

            $products = $products->sortByDesc(function($i, $k) use ($search_terms, $props) {
                // The bigger the weight, the higher the record
                $weight = 0;
                // Iterate through search terms
                foreach($search_terms as $searchTerm) {
                    // Iterate through products (address1, address2...)
                    foreach($props as $prop) {
                        // Use strpos instead of %value% (cause php)
                        if(strpos($i->{$prop}, $searchTerm) !== false)
                            $weight += 1; // Increase weight if the search term is found
                    }
                }

                return $weight;
                });

                foreach ($products as $row) {

                    $rate = $row->rating()->avg('rate');
                    $rate = number_format((float)$rate, 1, '.', '');
                    $row->avg_rate = $rate;

                }

                $products = $products->values()->all();

                if(!empty($products[0])){

                    return response(['products' => $products], 200);
                }
                else{
                    return response(['products' =>[]], 200);
                }
            }
    }

    public function popular(){

        $product= Product::get();

        // $product = App\Product::whereHas('rating',function($q){ return $q; });

        if(!empty($product)){

            foreach ($product as $row) {

                $rate = $row->rating()->avg('rate');
                $rate = number_format((float)$rate, 1, '.', '');
                $row->avg_rate = $rate;

            }
            return response(['popular_products' => $product], 200);
        }

        

    }

    public function recent(){

        $product = Product::orderBy('id', 'desc')->take(20)->get();

        if(!empty($product)){

            foreach ($product as $row) {

                $rate = $row->rating()->avg('rate');
                $rate = number_format((float)$rate, 1, '.', '');
                $row->avg_rate = $rate;
            }
        }

        return response(['recent_products' => $product], 200);
    }

     public function store_rating(Request $request){

        $validator = Validator::make($request->all(), [ 
            'product_id' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $product = new ProductRating;

        $product->user_id = auth()->user()->id;
        $product->product_id = $request->product_id;
        $product->review = $request->review;
        $product->rate = $request->rate;
        $product->save();

        if($product){
            return response()->json(['success'=>'Product Rate/Review Successfully!'], 200); 
        }
        else{
            return response()->json(['success'=>'Product Failed to Rate/Review!'], 422); 
        }

    }
}
