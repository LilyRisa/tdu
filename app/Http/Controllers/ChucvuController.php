<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\chucvu;

class ChucvuController extends Controller
{
    public function list(){
        $cv = chucvu::all();
        return view('chucvu', ['chucvu' => $cv]);
    }
    public function add(Request $request){
        $cv = new chucvu();
        $cv->name = $request->input('name');
        $cv->icon = '';
        $cv->save();
        return response()->json(['is' => true]);
    }
}
