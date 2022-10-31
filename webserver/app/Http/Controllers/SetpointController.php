<?php

namespace App\Http\Controllers;
use App\Events\ArduinoEvent;
use App\Events\PoolEvent;
use Illuminate\Http\Request;

class SetpointController extends Controller
{
    public function pool(Request $request){

        event(new PoolEvent($request->all(),"pool", $request->username, $request->guid));
        return $request->all();
    }

    public function set(Request $request){
        // echo "window.Echo.channel('set_vannyezha_grome800000001').listen('PoolEvent', function(data){console.log(data)})";

        // event(new PoolEvent($request->all(),"set", "vannyezha", "grome800000001"));
        // return $request->all();
        // return "<script>window.Echo.channel('set_vannyezha_grome800000001').listen('PoolEvent', function(data){
            // console.log(data)
        // })</script>";
        // return view('layouts.ws');
        return ["pesan"=>1];
    }
}
