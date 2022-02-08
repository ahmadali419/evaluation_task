<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
     public function index(){
        $categories  = Category::all();
         return view('order',compact('categories'));
     }

     public function generateOrder(Request $request){
          $validate = true;
          $validateInput = $request->all();
          $rules = [
              'username' => 'required',
              'email' => 'required',
              'cat_id' => 'required',
              'product_id.*' => 'required',
              'qty.*' => 'required',
              'price.*' => 'required',  
          ];
          $messages = [
              'product_id.*.required' => 'The Product field is required!',
              'qty.*.required' => 'The Qty field is required!',
              'price.*.required' => 'The Price  field is required!',
          ];
          $validator = Validator::make($validateInput, $rules, $messages);

          if ($validator->fails()) {
               $errors = $validator->errors();
   
               $allMsg = [];
               foreach ($errors->all() as $message) {
                   $allMsg[] = $message;
               }
               $return['error'] = collect($allMsg)->implode('<br />');
               $return['statusCode'] = '422'; 
               $validate = false;
               return response()->json($return);
           }else{

            $product_id = $request->product_id;
            $qty = $request->qty;
            $price = $request->price;
            $qty = $request->total_price;
            $totalPrice = $request->order_total_price;
            $orderDetail =  new Order;
            $orderDetail->username = $request->username;
            $orderDetail->email = $request->email;
            $orderDetail->total = $request->total_price;
            $orderDetail->note = $request->note;
            $orderDetail->save();
            if(!empty($orderDetail->id)){
                 $orderDetail_arr = [];
                 foreach($product_id as $key=>$val){
                    $orderDetail_arr[] = [
                         'order_id'=>$orderDetail->id,
                         'product_id'=>$val,
                         'price'=>$price[$key],
                         'qty'=>$qty[$key],
                         'total'=>$totalPrice[$key],
                         'created_at'=>Carbon::now()->format('Y-m-d')
                    ];
                 } 
                if(!empty($orderDetail_arr)){
                    $query = OrderItem::insert($orderDetail_arr);
                }
            }
            $response = ['status'=>'error','statusCode'=>400];
            if($query){
                 $response = ['status'=>'sucess','statusCode'=>200,'message'=>'Your order generated succesfully!'];
            }
            return response()->json($response);
           }
     }

     public function successMessage(){
          return view('success');
     }
}
