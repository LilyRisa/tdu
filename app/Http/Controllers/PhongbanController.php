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
}
