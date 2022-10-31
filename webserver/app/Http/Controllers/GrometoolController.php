<?php

namespace App\Http\Controllers;

use App\Events\PoolEvent;
use App\Models\Grometool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Object_;

class GrometoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guid(Request $request)
    {
        if ($request->username == Auth::user()->username && in_array($request->guid,Auth::user()->grometools->pluck('guid')->toArray())) {
            // return ['username'=>$request->username,'guid'=>$request->guid];
            $variable = json_decode(Grometool::where('guid',$request->guid)->first()->setpoint)->variable;
            return view('pages.grometool.guid', ['username'=>$request->username, 'guid'=>$request->guid, 'variables'=>$variable]);
        }
        return view('pages.utility.404');
    }

    public function profile(Request $request){
        $user = DB::table('users')->where('username',$request->username)->first();
        if ($user) {
            return 'hi'.' '.(string)$user->name;
            # code...
        }
        return view('pages.utility.404');
    }

    // public function getpoint(Request $request){
    //     if ( // if auth username == request username and guid in username's guid and setpoint in guid's setpoint variable
    //         Auth::user()->username == Grometool::where('username',$request->username)->first()->username &&
    //         in_array($request->guid,Auth::user()->grometools->pluck('guid')->toArray()) &&
    //         in_array($request->setpoint,json_decode(Grometool::where('guid',$request->guid)->first()->setpoint)->variable)
    //     )
    //     {
    //         // select table based on guid
    //         $modifiedSetpoint = json_decode(Grometool::where('guid',$request->guid)->first()->setpoint);
    //         // obtain which setpoint will be updated
    //         $variable = $request->setpoint;
    //         // update variable that meant
    //         $modifiedSetpoint->data->$variable = floatval($request->value);
    //         // encode json
    //         $modifiedSetpoint = json_encode($modifiedSetpoint);
    //         // update database based on the following query
    //         $status = Grometool::where('guid',$request->guid)->update(array('setpoint'=>$modifiedSetpoint));

    //         return Grometool::where('guid',$request->guid)->first()->setpoint;
    //         // return $request->username;
    //     }

    //     return "salah bang";
    // }

    public function setpoint(Request $request){
        if ( // if auth username == request username and guid in username's guid and setpoint in guid's setpoint variable
            Auth::user()->username == Grometool::where('username',$request->input('username'))->first()->username &&
            in_array($request->input('guid'),Auth::user()->grometools->pluck('guid')->toArray()) &&
            in_array($request->input('variable'),json_decode(Grometool::where('guid',$request->input('guid'))->first()->setpoint)->variable)
        )
        {
            // select table based on guid
            $modifiedSetpoint = json_decode(Grometool::where('guid',$request->input('guid'))->first()->setpoint);
            // obtain which setpoint will be updated
            $variable = $request->input('variable');
            // update variable that meant
            $modifiedSetpoint->data->$variable = floatval($request->input('setpoint'));
            // encode json
            $modifiedSetpoint = json_encode($modifiedSetpoint);
            // update database based on the following query
            $status = Grometool::where('guid',$request->input('guid'))->update(array('setpoint'=>$modifiedSetpoint));

            event(new PoolEvent(json_decode($modifiedSetpoint, true),"set" ,$request->input('username'),$request->input('guid')));
            // return Grometool::where('guid',$request->guid)->first()->setpoint;
            return back();
        }

        return $request->input();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grometool  $grometool
     * @return \Illuminate\Http\Response
     */
    public function show(Grometool $grometool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grometool  $grometool
     * @return \Illuminate\Http\Response
     */
    public function edit(Grometool $grometool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grometool  $grometool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grometool $grometool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grometool  $grometool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grometool $grometool)
    {
        //
    }
}
