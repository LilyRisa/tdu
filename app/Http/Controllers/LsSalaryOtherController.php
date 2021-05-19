<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\lsSalaryOther;

class LsSalaryOtherController extends Controller
{
    public function list(){
        $phucap = lsSalaryOther::all();
        return view('salaryother', ['phucap' => $phucap,]);
    }
    public function add(Request $request){
        $phucap_other = lsSalaryOther::where('name',$request->input('name'))->get();
        if(count($phucap_other) == 0){
            $phucap = new lsSalaryOther();
            $phucap->name = $request->input('name');
            if($request->input('percent') == 'true'){
                $phucap->salary_type = true;
            }else{
                $phucap->salary_type = false;
            }
            $phucap->salary = $request->input('salary');
            $phucap->save();
            return response()->json(['is' => true]);
        }
        return response()->json(['is' => false, 'messenge' => 'Tên phụ cấp đã tồn tại']);
        
    }

    public function edit(Request $request){
        $pb = lsSalaryOther::find($request->input('id'));
        if($request->input('name') != null){
            $pb->name = $request->input('name');
        }
        $pb->save();
        return response()->json(['is' => true]);
    }

    public function delete(Request $request){
        $pb = lsSalaryOther::find($request->input('id'));
        $pb->delete();
        return response()->json(['is' => true]);
    }
}
