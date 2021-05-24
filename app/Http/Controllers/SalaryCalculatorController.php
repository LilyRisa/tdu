<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalaryCalculator;
use App\Jobs\SendEmail;
use App\Jobs\PhoneSms;
use App\Models\User;
use App\Models\LogSmsEmail;


class SalaryCalculatorController extends Controller
{
    public function get(Request $request){
        $start = strtotime($request->input('time_start'));
        $end = strtotime($request->input('time_end'));
        $salary = SalaryCalculator::where('created_at', '>=', $start)->where('created_at', '<=', $end)->get();
        return \Response()->json($salary);
    }

    public function getAll(){
        $salary = SalaryCalculator::all();
        return \Response()->json($salary);
    }

    public function save(Request $request){
        $sc = new SalaryCalculator();
        $sc->fill($request->all());
        $sc->save();
        return response()->json(['is' => true]);
    }

    public function delete(Request $request){
        $sc = SalaryCalculator::find($request->input('id'));
        $sc->delete();
        return response()->json(['is' => true]);
    }

    public function sendSms(Request $request){
        $net = $request->input('net');
        $gross = $request->input('gross');
        $tn = $request->input('tn');
        $created_at = $request->input('created_at');
        $phone = '+84'.$request->input('phone');
        $phone = new PhoneSms('Muc luong net: '.$net.' - Gross: '.$gross.' - thuc nhan: '.$tn.'. Duoc khoi tao luc '.$created_at.'. Truy cap tai day de xem day du hon '.route('index'), $phone);
        $phone->sendMessage();
        $logg = new LogSmsEmail();
        $logg->type = true;
        $logg->save();
        return response()->json(['is' => true]);
    }

    public function sendEmail(Request $request){
        $net = $request->input('net');
        $gross = $request->input('gross');
        $tn = $request->input('tn');
        $leave = $request->input('leave');
        $created_at = $request->input('created_at');
        $user_get = User::where('id',$request->input('user_id'))->with('phongban')->with('chucvu')->first();
        SendEmail::dispatch($user_get, $user_get->email, [
            'title' => 'Mức lương hiện tại của bạn được cập nhật vào lúc '.$created_at,
            'body' => 'Mức lương Gross: <h3>'.$gross.'</h3></br/>Mức lương Net: <h3>'.$net.'</h3></br/>Số ngày nghỉ: <h3>'.$leave.' ngày</h3></br/>Lương thực nhận: <h3>'.$tn.'</h3></br/>  <p><i>Khởi tạo lúc: '.$created_at.'</i></p> </br/> truy cập vào link sau để xem lại <a href="'.route('index').'">'.route('index').'</a>',
            'image' => 'https://scopeblog.stanford.edu/wp-content/uploads/2019/04/aidan-bartos-313782-unsplash-1152x578.jpg'
            ]);
        $logg = new LogSmsEmail();
        $logg->type = false;
        $logg->save();
        return response()->json(['is' => true, 'user'=>$user_get]);
    }
}
