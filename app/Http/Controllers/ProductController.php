<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreProduct;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\ProductRating;
use App\Category;
use App\Product;
use Validator;
use App\User;
use Image;
use DB;

class ProductController extends Controller
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
            // dd($product);
            return Datatables::of($product)
                ->addColumn('action', function ($product) {
                    return view('manage.actions.actions_product',compact('product'));
                    })
                ->addColumn('image', function ($product) {
                        if($product->image != Null){
                            return '<img src="'.$product->image.'" width="200" height="200" class="img-thumbnail" style="max-width:170px">';
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
                ->editColumn('description',  function ($product) {
                        return substr($product->description,0,30).'...';

                    })
                ->rawColumns(['user_name','image'])
                ->make(true);
            }
            return view('manage.product.index');
            
        }
        else if(auth()->user()->role == 'vendor'){
            if($request->ajax()){

            $product = Product::with(['user:id,name','rating'])->withCount('scans')->where('user_id',auth()->user()->id)->get();
            // $product = ProductRating::avg('rate');
            // dd($product);
            return Datatables::of($product)
                ->addColumn('action', function ($product) {
                    return view('manage.actions.actions_product',compact('product'));
                    })
                ->addColumn('user_name', function ($product) {
                        return $product->user->name;

                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
            }
            return view('manage.product.index');
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
    public function store(Request $request)
    {
         $rules = array(
            'user_id' => 'bail|required',
            'category_id' => 'bail|required',
            'title' => 'bail|required',
            'description' => 'bail|required',
            'site_url' => 'bail|required',
            'price' => 'bail|required',
         );

         $messages = array(
                'user_id.required' => 'Please select vendor'
            );

         $error = Validator::make($request->all(), $rules, $messages);

         if($error->fails())
         {
          return response()->json(['errors' => $error->errors()], 422);
         }

        $output =array();

        $product = new Product;

        if ($request['photo']){

            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $image_path = asset($request['picture']);
            $product->image = $image_path;

             $output += array(
                 'photo_success' => 'Image uploaded successfully',
                 'image'  => '<img width="170px" src="'.$image_path.'" class="img-thumbnail" />'
                );
            }
        
        if ($request['video']){

            $request['movie'] = $request->file('video')->store('public/storage');
            $request['movie'] = Storage::url($request['movie']);
            $video_path = asset($request['movie']);
            $product->video = $video_path;
            $output += array(
                 'video_success' => 'Video uploaded successfully',
                 'video'  => '<video controls width="350" class="img-thumbnail">

                          <source src="'.$video_path.'"
                                  type="video/webm">

                          Sorry, your browser doesnt support embedded videos.
                      </video>',
                );

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
        return view('manage.product.edit',compact('product','user','category'));
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
            'user_id' => 'bail|required',
            'category_id' => 'bail|required',
            'title' => 'bail|required',
            'description' => 'bail|required',
            'site_url' => 'bail|required',
            'price' => 'bail|required',
         );
        
         $messages = array(
                'user_id.required' => 'Please select vendor'
            );

         $error = Validator::make($request->all(), $rules, $messages);

         if($error->fails())
         {
          return response()->json(['errors' => $error->errors()], 422);
         }

        $output =array();

        $product = product::find($id);

        if ($request['photo']){

            $request['picture'] = $request->file('photo')->store('public/storage');
            $request['picture'] = Storage::url($request['picture']);
            $image_path = asset($request['picture']);
            $product->image = $image_path;

             $output += array(
                 'photo_success' => 'Image uploaded successfully',
                 'image'  => '<img width="170px" src="'.$image_path.'" class="img-thumbnail" />'
                );
            }
        
        if ($request['video']){

            $request['movie'] = $request->file('video')->store('public/storage');
            $request['movie'] = Storage::url($request['movie']);
            $video_path = asset($request['movie']);
            $product->video = $video_path;
            $output += array(
                 'video_success' => 'Video uploaded successfully',
                 'video'  => '<video controls width="350" class="img-thumbnail">

                          <source src="'.$video_path.'"
                                  type="video/webm">

                          Sorry, your browser doesnt support embedded videos.
                      </video>',
                );

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
            $output += array(
                'data_save' => 'Product Updated successfully',
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
        $product = product::find($id)->delete();
        if($product){
            return view('manage.product.index');
        }
    }

    public function import_products(){
        $user = User::pluck('name','id');
        $category = Category::pluck('name', 'id');
        return view('manage.product.import-products',compact('user','category'));
    }

    public function store_import_products(Request $request){

        $validator = Validator::make($request->all(), [
            'products' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $file = $request->file('products');
        $csvData = file_get_contents($file);
        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);


        foreach($rows as $row){
            $product = new product;
            if ($row[0] !== null){
                $row = array_combine($header, $row);

                $cat = Category::where('name',$row['category'])->first();
                if ($cat){
                    $row['category'] = $cat->id;
                }else{
                    $ct = new Category;
                    $ct = $ct->create(['name'=>$row['category']]);
                    $row['category'] = $ct->id;
                }
                $product->user_id = $request->user_id;
                $product->category_id = $row['category'];
                $product->title = $row['title'];
                $product->setAttribute('slug', $row['title']);
                $product->description = $row['description'];
                $product->image = $row['image'];
                // $product->product_id = $row['product_id'];
                $product->price = $row['price'] ? $row['price']:0.0;
                $product->site_url = $row['site_url'];
                $product->tags = $row['tags'];
                $product->save();
            }
        }
        if($product){
            Session::flash('message', 'Products are Imported Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect('products');
        }
    }
}
