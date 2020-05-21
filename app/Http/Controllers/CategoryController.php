<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            $category = Category::select(['id','parent_id', 'name','created_at', 'updated_at']);
            // dd($category);
            return Datatables::of($category)
                ->addColumn('action', function($category) {
                    return view('manage.actions.actions_category',compact('category'));
                    })
                ->addColumn('parent_name', function($category) {
                        if($category->parent_id == Null){
                            return '__';
                        }
                        else{
                            $category = Category::where('id', $category->parent_id)->select('name')->first();
                            return $category->name;
                        }
                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
        }
       return view('manage.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_category = Category::where('parent_id','=',null)->pluck('name', 'id');
        return view('manage.category.create',compact('parent_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $category = new Category;
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->save();

        if($category){
            Session::flash('message', 'Category Created Successfully!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect('categories');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::where('parent_id','=',null)->pluck('name', 'id');
        return view('manage.category.edit',compact('category','categories'));
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
        $category = Category::find($id);

        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->save();

        if($category){
            Session::flash('message', 'Category Updated Successfully!'); 
            Session::flash('alert-class', 'alert-success');
            return redirect('categories');
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
        $category = Category::find($id)->delete();
        if($category){
            return view('manage.category.index');
        }
    }
}
