<?php

namespace App\Http\Controllers;
use App\Events\ArduinoEvent;
use App\Events\PoolEvent;
use App\Models\Grometool;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetpointController extends Controller
{
    public function postset(Request $request){
        // $modifiedSetpoint = json_decode(Grometool::where('guid',$request->guid)->first()->setpoint);
        // $variable = $request->input('variable');
        // $variable = "air_humidity";
        // update variable that meant
        // $modifiedSetpoint->data->$variable = floatval($request->input('setpoint'));
        // encode json
        // $modifiedSetpoint = json_encode($modifiedSetpoint);
        // update database based on the following query
        // $status = Grometool::where('guid',$request->input('guid'))->update(array('setpoint'=>$modifiedSetpoint));

        // event(new PoolEvent($request->all(),"pool", $request->username, $request->guid));
        return json_decode(Grometool::where("guid",$request->guid)->first()->setpoint)->data;
        // return $request->all();
        // return json_decode($modifiedSetpoint);
    }

    public function pool(Request $request){
        // echo "window.Echo.channel('set_vannyezha_grome800000001').listen('PoolEvent', function(data){console.log(data)})";

        // event(new PoolEvent($request->all(),"set", "vannyezha", "grome800000001"));
        // return $request->all();
        return [
            "status" => 200,
            "refresh" => 1,
        ];
    }
}
