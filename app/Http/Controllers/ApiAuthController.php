<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
        //register
    public function register(Request $request){
      $validator =  Validator::make($request->all(),[
            "name"=>"required|string|max:255",
            "email"=>"required|email|max:255",
            "password"=>"required|min:8|confirmed",
        ]);
        //check errors
        if ($validator->fails()) {
            return response()->json([
                "errors"=>$validator->errors()
            ],301);
        }

        // passwordhash
        $password = bcrypt($request->password);
        $access_token = Str::random(64);
        //create
        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>$password,
            "access_token"=>$access_token
        ]);
        //msg
        return response()->json([
            "success"=>"your register is successfully",
            "access_token"=>$access_token
        ],201);
    }

    //login
    public function login(Request $request){
        //validation
      $validator =  Validator::make($request->all(),[
            "email"=>"required|string|max:255",
            "password"=>"required|min:8"
        ]);

        //check errors
        if ($validator->fails()) {
           return response()->json([
            "errors"=>$validator->errors()
            ],300);
        }

        //check email & password

    $user=User::where("email","=",$request->email)->first();

    if ($user !== null) {
        //password
        $oldpassword = $user->password ;
       $isVerified = Hash::check($request->password,$oldpassword);

       if ($isVerified) {
        $newToken = Str::random(64);
        //update token in database
        $user->update([
            "access_token"=> $newToken
        ]);
        //return data with new access token
        return response()->json([
            "msg"=>"you loged in successfuly",
            "access_token"=>$newToken
            ],200);

       }else{
        return response()->json([
            "msg"=>"password not correct"
            ],404);
       }

    }else {
        return response()->json([
            "msg"=>"email not correct"
            ],404);
    }
    }
    //logout
    public function logout(Request $request){
        //Check access token
      $access_token = $request->header("access_token");
      if ($access_token !== null) {
       $user = User::where("access_token","=",$access_token)->first();
       //check access token user
            if ($user !== null) {
                //logout & update access_token
                $user->update([
                    "access_token"=>"NULL   "
                ]);
                return response()->json([
                    "msg"=>"logout successfully"
                    ],200);
            }else {
                return response()->json([
                    "msg"=>"access token not correct"
                    ],404);
            }
      }else {
        return response()->json([
            "msg"=>"access_token not found"
            ],404);

      }

    }
}
