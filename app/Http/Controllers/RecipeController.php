<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreRecipe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Recipe;
use Validator;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
        if($request->ajax()){

            $recipe = Recipe::all();
            return Datatables::of($recipe)
                ->addColumn('action', function ($recipe) {
                    return view('manage.actions.actions_recipe',compact('recipe'));
                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }
       return view('manage.recipe.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('manage.recipe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title' => 'bail|required',
            'ingredients' => 'bail|required',
            'recipe' => 'bail|required',
            'site_url' => 'bail|required',
            'price' => 'bail|required',
         );

         $error = Validator::make($request->all(), $rules);

         if($error->fails())
         {
          return response()->json(['errors' => $error->errors()], 422);
         }

        $output =array();

        $recipe = new Recipe;

        if ($request['photo']){

            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $image_path = asset($request['picture']);
            $recipe->image = $image_path;

             $output += array(
                 'photo_success' => 'Image uploaded successfully',
                 'image'  => '<img width="170px" src="'.$image_path.'" class="img-thumbnail" />'
                );
            }
        
        if ($request['video']){

            $request['movie'] = $request->file('video')->store('public/storage');
            $request['movie'] = Storage::url($request['movie']);
            $video_path = asset($request['movie']);
            $recipe->video = $video_path;
            $output += array(
                 'video_success' => 'Video uploaded successfully',
                 'video'  => '<video controls width="350" class="img-thumbnail">

                          <source src="'.$video_path.'"
                                  type="video/webm">

                          Sorry, your browser doesnt support embedded videos.
                      </video>',
                );

            }

        $recipe->title = $request->title;
        $recipe->setAttribute('slug', $request->title);
        $recipe->ingredients = $request->ingredients;
        $recipe->recipe = $request->recipe;
        $recipe->address = $request->address;
        $recipe->price = $request->price;
        $recipe->site_url = $request->site_url;
        $recipe->save();

        if($recipe){
            $output += array(
                'data_save' => 'Product Created successfully',
            );
            return response()->json($output); 
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);
        return view('manage.recipe.show',compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        return view('manage.recipe.edit',compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = array(
            'title' => 'bail|required',
            'ingredients' => 'bail|required',
            'recipe' => 'bail|required',
            'site_url' => 'bail|required',
            'price' => 'bail|required',
         );

         $error = Validator::make($request->all(), $rules);

         if($error->fails())
         {
          return response()->json(['errors' => $error->errors()], 422);
         }

        $output =array();

        $recipe = Recipe::find($id);

        if ($request['photo']){

            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $image_path = asset($request['picture']);
            $recipe->image = $image_path;

             $output += array(
                 'photo_success' => 'Image uploaded successfully',
                 'image'  => '<img width="170px" src="'.$image_path.'" class="img-thumbnail" />'
                );
            }
        
        if ($request['video']){

            $request['movie'] = $request->file('video')->store('public/storage');
            $request['movie'] = Storage::url($request['movie']);
            $video_path = asset($request['movie']);
            $recipe->video = $video_path;
            $output += array(
                 'video_success' => 'Video uploaded successfully',
                 'video'  => '<video controls width="350" class="img-thumbnail">

                          <source src="'.$video_path.'"
                                  type="video/webm">

                          Sorry, your browser doesnt support embedded videos.
                      </video>',
                );
            }

        $recipe->title = $request->title;
        $recipe->ingredients = $request->ingredients;
        $recipe->recipe = $request->recipe;
        $recipe->address = $request->address;
        $recipe->price = $request->price;
        $recipe->site_url = $request->site_url;
        $recipe->save();

        if($recipe){
            $output += array(
                'data_save' => 'Product Created successfully',
            );
            return response()->json($output); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id)->delete();
        if($recipe){
            return view('manage.recipe.index');
        }
    }
}
