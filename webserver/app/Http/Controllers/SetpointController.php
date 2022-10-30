<?php

namespace App\Http\Controllers;
use App\Events\ArduinoEvent;
use App\Events\PoolEvent;
use Illuminate\Http\Request;

class SetpointController extends Controller
{
    public function pool(Request $request){

        event(new PoolEvent($request->all(), $request->username, $request->guid));
        return $request->all();
    }
}
