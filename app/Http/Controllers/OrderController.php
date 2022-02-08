<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class OrderController extends Controller
{
     public function index(){
        $categories  = Category::all();
         return view('order',compact('categories'));
     }
}
