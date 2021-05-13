<?php

namespace App\Http\Controllers\Relationship;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Relationships\Product;
use App\Relationships\Category;
use App\Relationships\Order;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Country;

class ProductController extends Controller
{
    public $view = 'Relationships\products.';

    public function index(){
        $products = Product::get();
        $categories = Category::get();
        return view($this->view."index",compact('products','categories'));    
    }

    public function getProduct(Request $request){
        $product = Product::where('category_id',$request->id)->get();
        return response()->json($product);
    }

    public function getPrice(Request $request){
        $price = Product::where('id',$request->id)->pluck('price');
        return response()->json($price);
    }

    public function orderSave(Request $request){
        $cnt = 0;
        foreach($request->category as $val){
            $order = Order::create([
                'user_id'     => Auth::id(),
                'category_id' => $val,  
                'product_id'  => $request->product[$cnt],
                'price'       => $request->price[$cnt],
                'quantity'    => $request->quantity[$cnt],  
                'amount'      => $request->amount[$cnt]      
            ]);

            Order::find($order->id)->update(['order_id' => 'ORD-'.$order->id]);
            $cnt++;
        }
        return back();
    }

    public function getOrders(){

        //$country = Country::find(1);
        //$country->orders;
        $orders = Order::with(['product','category','user'])->where('user_id',Auth::id())->get();
        $category = Category::all();
        $product = Product::all();
        return view($this->view."order",compact('orders','category','product'));
    }
}
