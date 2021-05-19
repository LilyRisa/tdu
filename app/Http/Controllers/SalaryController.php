<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\salary;
use App\Models\User;
use App\Jobs\SendEmail;
use App\Jobs\PhoneSms;

class SalaryController extends Controller
{
    public function list(){
        $salary = salary::with('User')->get();
        $user = User::all();
        return view('salaries', ['salary' => $salary, 'user' => $user]);
    }
    public function add(Request $request){
        $salary_other = salary::where('user_id',$request->input('user_id'))->get();
        if($salary_other->isEmpty()){
            $salary = new salary();
            $salary->user_id = $request->input('user_id');
            $salary->salary  = $request->input('salary');
            $salary->save();
            return response()->json(['is' => true]);
        }else if((int)$request->input('salary') <= 1000000){
            return response()->json(['is' => false, 'messenges' => 'Tiền lương thấp hơn 1 triệu VND']);
        }else{
            return response()->json(['is' => false, 'messenges' => 'Nhân viên đã tồn tại']);
        }
        
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
        $pb = salary::find($request->input('id'));
        $pb->delete();
        return response()->json(['is' => true]);
    }

    public function NotiSalary(Request $request){
        $salary = $request->input('salary');
        $user_get = User::where('id',$request->input('user_id'))->with('phongban')->with('chucvu')->first();
        SendEmail::dispatch($user_get, $user_get->email, [
            'title' => 'Mức lương hiện tại của bạn được cập nhật vào lúc '.$request->input('time'),
            'body' => 'Mức lương hiện tại của bạn là: <h3>'.number_format((int)$request->input('salary')).' VND</h3> truy cập vào link sau để xem lại <a href="'.route('index').'">'.route('index').'</a>',
            'image' => 'https://scopeblog.stanford.edu/wp-content/uploads/2019/04/aidan-bartos-313782-unsplash-1152x578.jpg'
            ]);
        return response()->json(['is' => true, 'user'=>$user_get]);
    }

    public function NotiSalaryPhone(Request $request){
        $salary = $request->input('salary');
        $phone = '+84'.$request->input('phone');
        $phone = new PhoneSms('Muc luong hien tai cua ban la: '.number_format((int)$request->input('salary')).'VND vao thoi gian '.$request->input('time').'. Truy cap tai day de xem day du hon '.route('index'), $phone);
        $phone->sendMessage();
        return response()->json(['is' => true]);

    }
}
