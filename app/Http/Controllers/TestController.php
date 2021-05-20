<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Config;
use App\Jobs\FaceRecogn;


class TestController extends Controller
{
    public function test(){
        dd(Config('app.FaceRecogn_token'));
    }
    
    public function face($username){
        $us = User::where('username', $username)->first();
        $face = new FaceRecogn($us);
        $a = $face->set_face_recogn();
        return \Response()->json($a);
    }

    public function demo(){
        return view('demo');
    }
}
