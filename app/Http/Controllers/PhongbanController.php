<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\phongban;
use App\Models\chucvu;

class PhongbanController extends Controller
{
    public function list(){
        $pb = phongban::with('chucvu')->get();
        $cv = chucvu::all();
        return view('phongban', ['phongban' => $pb, 'chucvu' => $cv]);
    }
    public function add(Request $request){
        $pb = new phongban();
        $pb->name = $request->input('name');
        $pb->icon = '';
        $pb->chucvu_id = $request->input('chucvu_id');
        $pb->save();
        return response()->json(['is' => true]);
    }

    public function edit(Request $request){
        $pb = phongban::find($request->input('id'));
        if($request->input('name') != null){
            $pb->name = $request->input('name');
        }
        if($request->input('chucvu') != null){
            $pb->chucvu_id = $request->input('chucvu');
        }
        $pb->save();
        return response()->json(['is' => true]);
    }

    public function delete(Request $request){
        $pb = phongban::find($request->input('id'));
        $pb->delete();
        return response()->json(['is' => true]);
    }

    public function GetColor(Request $request){
        $cv = chucvu::find($request->input('id'));
        return response()->json(['return' => $cv]);
    }
}
