<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function GuzzleHttp\Promise\all;

class ProductRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            $product = ProductRequest::all();
            // dd($product);
            return Datatables::of($product)
                ->addColumn('action', function ($product) {
                    return view('manage.actions.actions_product_request',compact('product'));
                })
                ->addColumn('image', function ($product) {
                        if($product->image != Null){
                            return '<img src="'.$product->image.'" width="200" height="200" class="img-thumbnail" style="max-width:170px">';
                        }else{
                            return '<b>No Image Yet!</b>';
                        }

                    })
                ->editColumn('id', 'ID: {{$id}}')
                ->rawColumns(['image'])
                ->make(true);
        }
        return view('manage.product_request.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductRequest  $productRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ProductRequest $productRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductRequest  $productRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductRequest $productRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductRequest  $productRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductRequest $productRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductRequest  $productRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = ProductRequest::whereId($id)->first();
        if($prod->delete()){
            return response()->json(['message'=>'success'],200);
        }else {
            return response()->json(['message'=>'error'],400);
        }
    }
}
