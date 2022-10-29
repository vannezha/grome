<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index(){
        return view('pages/dashboard/community');
    }
    public function vanny(){
        return Auth::user();
    }
}
