<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductRequestController extends Controller
{
    public function dorequest(Request $request){
        $re = new ProductRequest;
        $request['user_id'] = auth()->id();
        if ($request->picture){
            $request['image'] = $request->file('picture')->store('public/Rimages');
            $request['image'] = Storage::url($request['image']);
            $request['image'] = asset($request['image']);
        }
        $re->create($request->all());
        return response()->json(['message'=>'successfully requested'],200);
    }
}
