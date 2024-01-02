<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //All products

        public function allProducts(){
        $products = Product::all();
      return view("Admin.all",compact('products'));
    }

    // show Product
    public function show($id){
        $product = Product::findOrFail($id);
      return view("Admin.show",compact('product'));
    }



    //create

    public function create(){
        $categories = Category::all();
        return view("Admin.create",compact("categories"));
    }

    public function store(Request $request){
        //validation
     $data =  $request->validate([
            "name"=>"required|string|max:100",
            "desc"=>'required|string',
            "image"=>'required|image|mimes:png,jpg,jpeg',
            "price"=>"required|numeric",
            "quantity"=>'required|integer',
            "category_id"=>"required|exists:categories,id"
        ]);

        // storage

       $data['image'] = Storage::put("Products",$data['image']);

       // create

        Product::create($data);

        // redirct Form

        return redirect(url("products/create"))->with("success",__("message.data inserted successfuly"));




    }

        //edit
    public function edit($id){
        $product = Product::findOrFail($id);
        $categories= Category::all();
        return view("Admin.edit",compact("product","categories"));
    }
    // update data

    public function update(Request $request,$id){
        //validation
     $data =  $request->validate([
            "name"=>"required|string|max:100",
            "desc"=>'required|string',
            "image"=>'image|mimes:png,jpg,jpeg',
            "price"=>"required|numeric",
            "quantity"=>'required|integer',
            "category_id"=>"required|exists:categories,id"
        ]);

        $product = Product::findOrFail($id);
        // if image is not empty then upload it to the folder
        if ($request->has("image")) {
            Storage::delete($product->image);
            $data['image'] = Storage::put("products",$data['image']);

        }
        $product->update($data);
        return redirect(url("product/show/$id"))->with("success",__("message.data Update successfully"));

    }

    //delete

        public function delete($id){
            $product = Product::findOrFail($id);
            Storage::delete($product->image);
            $product->delete();
            // $products = Product::all();
            return redirect(url('products'))->with("success",__("message.product deleted successfully"));
        }

}