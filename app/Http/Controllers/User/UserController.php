<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //All products
    public function allProducts()
    {
        $products = Product::all();
        return view("user.home", compact('products'));
    }
    public function allProductsgest()
    {
        $products = Product::all();
        return view("welcome", compact('products'));
    }

    // show Product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categoryId = $product->category_id;
        $category = Category::findOrFail($categoryId);
        return view("user.show", compact('product', 'category'));
    }

    //searchbar
    public function search(Request $request)
    {
        $key = $request->key;
        $products = Product::where("name","like","%$key%")->get();

        return view('user.home', compact('products'));
    }

    // public function addToCart($id , Request $request)
    // {
    //     $qty = $request->qty;
    //     $product =Product::findOrFail($id);
    //     //cart first step create
    //     $cart = session()->get("cart");
    //     if (! $cart) {

    //         $cart = [ //create
    //             $id=>[
    //                 "name"=>$product->name,
    //                 "price"=>$product->price,
    //                 "image"=>$product->image,
    //                 "qty"=>$qty,
    //                 ]
    //             ];
    //             session()->put("cart",$cart);
    //             // dd (session()->get('cart'));
    //             return redirect()->back()->with("success","product added to cart successfuly");
    //         }else {
    //             if(isset($cart[$id]))
    //             {
    //                 $cart[$id]["qty"] += $qty ;
    //                 session()->put("cart",$cart);
    //                 // dd (session()->get('cart'));
    //                 return redirect()->back()->with("success","product added to cart successfuly");
    //             }
    //             $cart[$id]=[
    //                 "name"=>$product->name,
    //                 "price"=>$product->price,
    //                 "image"=>$product->image,
    //                 "qty"=>$qty,
    //             ];
    //             session()->put("cart",$cart);
    //             // dd (session()->get('cart'));
    //             return redirect()->back()->with("success","product added to cart successfuly");
    //         }
    // }
    public function addToCart($id , Request $request)
    {
      $product =  Product::findOrFail($id);
      $qty = $request->qty;
      if(! $product)
      {
         abort(404);
      }
      $cart = session()->get("cart");

      if(! $cart)
      {
        $cart = [
         $id => [
             "name"=>$product->name,
             "qty"=>$qty,
             "price"=>$product->price,
             "image"=>$product->image,
         ]
        ];
        session()->put("cart",$cart);
     //    dd(session()->get("cart"));
        return redirect()->back()->with("success","product addedd to cart successfuly");
      }else {
         if(isset($cart[$id])) {
             $oldqty = $cart[$id]["qty"];
             // dd($oldqty);
             // dd(($oldqty));
             $newQty = $oldqty + $qty;
                     $cart[$id]['qty'] = $newQty ;
                     session()->put('cart', $cart);
                     // dd(session()->get("cart"));
                     return redirect()->back()->with('success', 'Product added to cart successfully!');
          }else{
              $cart[$id] = [
                  "name"=>$product->name,
                  "qty"=>$qty,
                  "price"=>$product->price,
                  "image"=>$product->image,
                 ];
                 session()->put('cart', $cart);
                 return redirect()->back()->with('success', 'Product added to cart successfully!');
                 // dd(session()->get("cart"));
             }
      }
}
public function mycart()
{
    $products = session()->get('cart');
    $user = Auth::user() ;
    return view('user.myCard',compact("products","user"));
}


    public function makeOrder(Request $request)
    {
        $day = $request->day;
        $user_id = Auth::user()->id;
        $products = session()->get("cart");
        //order date , user_id
       $order=  Order::create([
            "requiredDate"=>$day,
            "user_id"=>$user_id
        ]);

        //orderdetails (order_number , products)
        foreach($products as $id=>$product){

            OrderDetails::create([
                
                "order_id"=>$order->id,
                "product_id"=>$id,
                "qty"=>$product['qty'],
                "price"=>$product['price']
            ]);
        }
        return redirect(url("redirect"))->with("success","you make order successfuly    ");
        }
}