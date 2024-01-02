<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    public function all(){

        $products = Product::all();
        return ProductResource::collection($products);
        // return response()->json($products);

    }
    public function show($id){

        $product = Product::find($id);
        if($product == null){
            return response()->json([
                "msg"=>"product not found"
            ],404);
        }
        return  new ProductResource($product);


    }

    public function store(Request $request){

        //valdition

       $validator = Validator::make($request->all(),[
            "name"=>"required|string|max:100",
            "desc"=>'required|string',
            "image"=>'required|image|mimes:png,jpg,jpeg',
            "price"=>"required|numeric",
            "quantity"=>'required|integer',
            "category_id"=>"required|exists:categories,id"
        ]);

        // check errors

        if($validator->fails())
        {
            return response()->json([
                "errors"=>$validator->errors()
            ],301);
        }

        //create
        $imageName = Storage::putFile('Product',$request->image);
        Product::create([
            "name"=>$request->name,
            "desc"=>$request->desc,
            "price"=>$request->price,
            "quantity"=>$request->quantity,
            "image"=>$request->image,
            "category_id"=>$request->category_id,
        ]);

        //msg
        return response()->json([
            "msg"=>"product add successfully"
        ],201);
    }


    // Update
        public function update($id,Request $request){
                //validation
            $validator = Validator::make($request->all(),[
                "name"=>"required|string|max:100",
                "desc"=>'required|string',
                "image"=>'image|mimes:png,jpg,jpeg',
                "price"=>"required|numeric",
                "quantity"=>'required|integer',
                "category_id"=>"required|exists:categories,id"
            ]);


                    if($validator->fails())
                    {
                        return response()->json([
                            "errors"=>$validator->errors()
                        ],301);
                    }
            //find
                    $product = Product::find($id);
                    if ($product == null) {
                        return response()->json([
                        "msg"=>"product not found"
                        ],404);
                    }
            //storage
                $imageName = $product->name ; //old

                if ($request->has("image")) {
                    if ($product->image !== null) {
                        Storage::delete($imageName);
                    }
                $imageName = Storage::putFile('Product',$request->image);

                }

                //update
                $product->update([
                    "name"=>$request->name,
                    "desc"=>$request->desc,
                    "price"=>$request->price,
                    "quantity"=>$request->quantity,
                    "image"=>$imageName,
                    "category_id"=>$request->category_id,
                ]

                );


                //msg
                return response()->json([
                    "msg"=>"product Updated successfully",
                    "product"=> new ProductResource($product),
                ],201);

        }

        //delete
        public function delete($id){
            $product = Product::find($id);
            if($product == null){
                return response()->json([
                    "msg"=>"product not found"
                ],404);
        }
        if ($product->image !== null) {
            Storage::delete($product->image);
        }
        $product->delete();
        //        msg
                 return response()->json([
                    "msg"=>"product deleted",
                ],200);





    }
}