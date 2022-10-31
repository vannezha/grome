<?php

namespace App\Http\Controllers;

use App\Models\Grometool;
use App\Models\User;
use ArduinoEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        if (Grometool::where('guid', $request->guid)->first()->username == $request->username &&
        Hash::check($request->password,User::where('username',$request->username)->first()->password)
        ) {
            $user = User::where('username',$request->username)->first();
            $token = $user->createToken($request->guid)->plainTextToken;
            return [
                'response'=> 200,
                'username'=> $request->username,
                'guid'=> $request->guid,
                'token' => $token,
            ];
        }
        return [
            "responses"=> 400,
        ];
    }


    public function logout(Request $request){
        if (Grometool::where('guid', $request->guid)->first()->username == $request->username &&
        Hash::check($request->password,User::where('username',$request->username)->first()->password)
        ) {
            auth()->user()->tokens()->where('name',$request->guid)->delete();
            return [
                'resposes'=> 200,
            ];
        }
        return [
            'resposes'=> 400,
        ];
    }


}
