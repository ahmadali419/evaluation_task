<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductByCategory(Request $request){
        $products  = Product::where('category_id',$request->id)->select('name','id')->get();
        $response = ['status'=>'error','statusCode'=>400,];
        if(!($products->isEmpty())){
            $response = ['status'=>'success','statusCode'=>200,'products'=>$products];
        }
        return response()->json($response);
    }
}
