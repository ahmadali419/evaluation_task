<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductByCategory(Request $request){
        $products  = Product::where('category_id',$request->id)->select('name','id')->get();
        $response = ['status'=>'error','statusCode'=>400];
        if(!($products->isEmpty())){
            $response = ['status'=>'success','statusCode'=>200,'products'=>$products];
        }
        return response()->json($response);
    }
    public function getProductPrice(Request $request){
        $productPrice  = Product::where('id',$request->id)->select('price')->first();
        $response = ['status'=>'error','statusCode'=>400];
        if(!empty($productPrice)){
            $response = ['status'=>'success','statusCode'=>200,'productPrice'=>$productPrice];
        }
        return response()->json($response);
    }
}
