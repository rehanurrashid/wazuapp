<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Recipe;
use App\Product;

class RecipeController extends Controller
{
    public function show_all(){

    	$recipe = Recipe::all();

    	if(!empty($recipe)){
    		return response(['recipes' => $recipe], 200);
    	}
    	else{
    		return response(['recipes' => 'No Recipes Found!'], 401);
    	}
    }

    // public function show($id){

    // 	$recipe = Recipe::find($id);

    // 	if(!empty($recipe)){

    // 		$ingredients_word = explode(",",$recipe->ingredients);

	   //  	$recipe['recipe_products'] = Recipe::where(function ($q) use ($ingredients_word) {
	   //          foreach ($ingredients_word as $value) {
	   //          	$q->orWhere('tags', 'like', '%'.$value.'%')
	   //          		->orWhere('title', 'like', '%'.$value.'%');
	   //          }
	   //       })->with(['rating'])->limit(5)->get();

	   //  	if(!empty($recipe['recipe_products'][0])){
	   //  		return response(['recipes' => $recipe], 200);
	   //  	}
	   //  	else{
	   //  		$recipe['recipe_products'] = 'No Related Recipes Found!';
	   //  		return response(['recipes' => $recipe], 200);
	   //  	}
    		
    // 	}
    // 	else{
    // 		return response(['recipes' => 'No Recipes Found!'], 401);
    // 	}
    // }

    public function show(Request $request){

        if($request->keyword == '' && $request->slug == ''){
            return response(['error' => 'Atleast one word(keyword/slug) is required for searching...!'], 200);
        }

        if(!empty($request->slug)){

            $recipe = Recipe::where('slug', $request->slug)->first();
            

            if(!empty($recipe)){

                $ingredients_word = explode(",",$recipe->ingredients);

                $recipe['recipe_products'] = Product::where(function ($q) use ($ingredients_word) {

                foreach ($ingredients_word as $value) {
                    $q->orWhere('tags', 'like', '%'.$value.'%')
                        ->orWhere('title', 'like', '%'.$value.'%');
                }
                 })->limit(5)->get();

                if(!empty($recipe['recipe_products'][0])){
                    return response(['recipes' => $recipe], 200);
                }
                else{
                    $recipe['recipe_products'] = 'No Related Recipes Found!';
                    return response(['recipes' => $recipe], 200);
                }
            }
            else{
                $recipe['recipe'] = 'No Recipe Found!';
                return response(['error' => $recipe], 200);
            }
        }
        else if(!empty($request->keyword)){

            $searchValues = preg_split('/\s /', $request->keyword, -1, PREG_SPLIT_NO_EMPTY);
            $search_terms = explode(" ", $searchValues[0]);
            // $recipes = Searchy::recipes('title')->query($searchValues[0])->get();
            $recipes = Recipe::where(function ($q) use ($search_terms) {
              foreach ($search_terms as $value) {
                $q->orWhere('title', 'like', '%'.$value.'%')
                    ->orWhere('ingredients', 'like', '%'.$value.'%');
              }
            })->get();

            $props = ['title'];

            $recipes = $recipes->sortByDesc(function($i, $k) use ($search_terms, $props) {
                // The bigger the weight, the higher the record
                $weight = 0;
                // Iterate through search terms
                foreach($search_terms as $searchTerm) {
                    // Iterate through recipes (address1, address2...)
                    foreach($props as $prop) {
                        // Use strpos instead of %value% (cause php)
                        if(strpos($i->{$prop}, $searchTerm) !== false)
                            $weight += 1; // Increase weight if the search term is found
                    }
                }

                return $weight;
                });


                $recipes = $recipes->values()->all();

                if(!empty($recipes[0])){

                    return response(['recipes' => $recipes], 200);
                }
                else{
                    return response(['recipes' =>[]], 200);
                }
            }
    }

}
