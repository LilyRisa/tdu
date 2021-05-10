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
        $cv->icon = $request->input('color');;
        $cv->save();
        return response()->json(['is' => true]);
    }

    public function edit(Request $request){
        $cv = chucvu::find($request->input('id'));
        if($request->input('name') != null){
            $cv->name = $request->input('name');
        }
        if($request->input('color') != null){
            $cv->icon = $request->input('color');
        }
        $cv->save();
        return response()->json(['is' => true]);
    }

    public function delete(Request $request){
        $cv = chucvu::find($request->input('id'));
        $cv->delete();
        return response()->json(['is' => true]);
    }
}
