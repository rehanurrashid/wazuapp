<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\ProductRating;
use App\Category;
use App\Product;
use Validator;
use App\User;
use Image;
use DB;

class PopularProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        if(auth()->user()->role == 'admin'){
            
            if($request->ajax()){

            $product = $product->newQuery()->with(['user','rating'])->withCount('scans')->get();
            // $product = ProductRating::avg('rate');
            
            if(!empty($product)){
                foreach ($product as $row) {

                    $rate = $row->rating()->avg('rate');
                    $rate = number_format((float)$rate, 1, '.', '');
                    $row->avg_rate = $rate;

                }
                $product = $product->SortByDesc('avg_rate');

                return Datatables::of($product)
                    ->addColumn('action', function ($product) {
                        return view('manage.actions.actions_popular_product',compact('product'));
                        })
                    ->addColumn('image', function ($product) {
                        if($product->image != Null){
                            return '<img src="'.$product->image.'" class="img-thumbnail" width="200" height="200" style="max-width:170px">';
                        }else{
                            return '<b>No Image Yet!</b>';
                        }

                    })
                    ->addColumn('user_name', function ($product) {
                        if($product->user != Null){
                            return $product->user->name;
                        }else{
                            return '<b>No Username!</b>';
                        }

                    })
                    ->editColumn('id', 'ID: {{$id}}')
                    ->setTotalRecords(10)
                    ->rawColumns(['user_name','image'])
                    ->make(true);
                    }
            
            }
            return view('manage.popular_product.index');
            
        }
        else if(auth()->user()->role == 'vendor'){
            if($request->ajax()){

            $product = $product->newQuery()->with(['user','rating'])->withCount('scans')->where('user_id',auth()->user()->id)->get();

            if(!empty($product)){
                foreach ($product as $row) {

                    $rate = $row->rating()->avg('rate');
                    $rate = number_format((float)$rate, 1, '.', '');
                    $row->avg_rate = $rate;

                }
                $product = $product->SortByDesc('avg_rate');
                return Datatables::of($product)
                    ->addColumn('action', function ($product) {
                        return view('manage.actions.actions_popular_product',compact('product'));
                        })
                    ->addColumn('user_name', function ($product) {
                            if($product->avg_rate >= 4){
                                return $product->user->name;
                            }

                        })
                    ->addColumn('image', function ($product) {
                        if($product->image != Null){
                            return '<img src="'.$product->image.'" class="img-thumbnail" width="200" height="200" style="max-width:170px">';
                        }else{
                            return '<b>No Image Yet!</b>';
                        }

                    })
                    ->addColumn('user_name', function ($product) {
                        if($product->user != Null){
                            return $product->user->name;
                        }else{
                            return '<b>No Username!</b>';
                        }

                    })
                    ->editColumn('id', 'ID: {{$id}}')
                    ->setTotalRecords(1)
                    ->rawColumns(['user_name','image'])
                    ->make(true);
                }
            }
            return view('manage.popular_product.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::pluck('name','id');
        $category = Category::pluck('name', 'id');
        return view('manage.product.create',compact('user','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeproduct $request)
    {
        $product = new product;

        if ($request['photo']){

            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            $product->image = $request['picture'];
        }
        if ($request['video']){

            $request['movie'] = $request->file('video')->store('public/storage');
            $request['movie'] = Storage::url($request['movie']);
            $request['movie'] = asset($request['movie']);
            // $filename = $request->file('photo')->hashName();
            $product->video = $request['movie'];
        }

        
        $product->user_id = $request->user_id;
        $product->category_id = $request->category_id;
        $product->setAttribute('slug', $request->title);
        $product->title = $request->title;
        $product->tags = $request->tags;
        $product->description = $request->description;
        $product->address = $request->address;
        $product->price = $request->price;
        $product->site_url = $request->site_url;
        $product->save();

        if($product){
            Session::flash('message', 'Product Created Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect('popular_products');
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
        $product = product::find($id);
        $user = User::pluck('name','id');
        $category = Category::pluck('name', 'id');
        return view('manage.popular_product.edit',compact('product','user','category'));
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
        $product = product::find($id);
         if($request->hasFile('photo')){
            //storing image

            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $request['picture'] = asset($request['picture']);
            // $filename = $request->file('photo')->hashName();
            $product->image = $request['picture'];
         }

         if ($request['video']){

            $request['movie'] = $request->file('video')->store('public/storage');
            $request['movie'] = Storage::url($request['movie']);
            $request['movie'] = asset($request['movie']);
            // $filename = $request->file('photo')->hashName();
            $product->video = $request['movie'];
        }


        $product->user_id = $request->user_id;
        $product->category_id = $request->category_id;
        $product->title = $request->title;
        $product->tags = $request->tags;
        $product->description = $request->description;
        $product->address = $request->address;
        $product->price = $request->price;
        $product->site_url = $request->site_url;
        $product->save();

        if($product){
            Session::flash('message', 'Product Updated Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect('popular_popular_products');
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
        $product = product::find($id)->delete();
        if($product){
            return view('manage.product.index');
        }
    }

}
