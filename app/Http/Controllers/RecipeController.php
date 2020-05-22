<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreRecipe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Recipe;

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
    public function store(StoreRecipe $request)
    {
        $recipe = new Recipe;

        if ($request['photo']){

            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            $recipe->image = $request['picture'];
        }
        if ($request['video']){

            $request['movie'] = $request->file('video')->store('public/storage');
            $request['movie'] = Storage::url($request['movie']);
            $request['movie'] = asset($request['movie']);
            // $filename = $request->file('photo')->hashName();
            $recipe->video = $request['movie'];
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
            Session::flash('message', 'Recipe Created Successfully!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect('recipes');  
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
        $recipe = Recipe::find($id);

        if ($request['photo']){

            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            $recipe->image = $request['picture'];
        }
        if ($request['video']){

            $request['movie'] = $request->file('video')->store('public/storage');
            $request['movie'] = Storage::url($request['movie']);
            $request['movie'] = asset($request['movie']);
            // $filename = $request->file('photo')->hashName();
            $recipe->video = $request['movie'];
        }
        
        $recipe->title = $request->title;
        $recipe->ingredients = $request->ingredients;
        $recipe->recipe = $request->recipe;
        $recipe->address = $request->address;
        $recipe->price = $request->price;
        $recipe->site_url = $request->site_url;
        $recipe->save();

        if($recipe){
            Session::flash('message', 'Recipe Updated Successfully!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect('recipes');  
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
        //
    }
}
