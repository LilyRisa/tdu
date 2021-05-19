<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\salary;
use App\Models\phongban;
use App\Models\chucvu;
use App\Models\phucap;
use Carbon\Carbon;

class PhucapController extends Controller
{
    public function list(){
        $phucap = phucap::with('phongban')->with('chucvu')->get();
        $phongban = phongban::all();
        $chucvu = chucvu::all();
        return view('phucap', ['phucap' => $phucap, 'phongban' => $phongban, 'chucvu' => $chucvu]);
    }
    public function add(Request $request){
        $phucap_other = phucap::where('chucvu_id',$request->input('chucvu_id'))->where('phongban_id',$request->input('phongban_id'))->get();
        foreach($phucap_other as $pcot){
            if(strtotime($pcot->time_end) >= strtotime($request->input('time_start'))){
                return response()->json(['is' => false, 'messenge' => 'Phụ cấp của phòng ban đã tồn tại không thể bắt đầu thời gian nhỏ hơn thời gian kết thúc của trường cũ']);
            }
        }
        $phucap = new phucap();
        $phucap->chucvu_id = $request->input('chucvu_id');
        $phucap->phongban_id = $request->input('phongban_id');
        $phucap->time_start = Carbon::parse($request->input('time_start'))->format('Y-m-d');
        $phucap->time_end = Carbon::parse($request->input('time_end'))->format('Y-m-d');
        if($request->input('percent') == 'true'){
            $phucap->precent_salary = true;
        }else{
            $phucap->precent_salary = false;
        }
        $phucap->salary = $request->input('salary');
        $phucap->save();
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
        $pb = phucap::find($request->input('id'));
        $pb->delete();
        return response()->json(['is' => true]);
    }

    public function GetSalary(Request $request){
        $pc = phucap::where('chucvu_id',$request->input('chucvu'))
            ->where('phongban_id', $request->input('phongban'))
            ->where('time_start', '<=', date("Y-m-d"))
            ->where('time_end', '>=', date("Y-m-d"))->first();
        return response()->json(['data' => $pc]);
    }
}
