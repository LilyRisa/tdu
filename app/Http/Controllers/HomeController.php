<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Calendar;
use App\Models\phongban;
use App\Models\chucvu;
use App\Jobs\CovidApi;
use App\Models\LogSmsEmail;

class HomeController extends Controller
{
    public function index(){
        if(!Auth::check()) 
        {
            return redirect()->route('login');
        }
        $log = DB::select('select * from sessions');
        $log = array_map(function($item){
            $item->user = $item->user_id != null ? User::where('id',$item->user_id)->first() : null;
            $item->last_activity = $item->last_activity != null ? Carbon::createFromTimestamp(intval($item->last_activity))->timezone('asia/ho_chi_minh')->format('H:i:s Y-m-d') : null;
            return $item;
        },$log);
        $calendar = Calendar::all();
        $phongban = count(phongban::all()->toArray());
        $chucvu = count(chucvu::all()->toArray());
        $count_active = 0;
        $user = User::all()->toArray();
        foreach($user as $us){
            $count_active = $us['isActive'] == 1 ? $count_active + 1 : $count_active + 0;
        }
        $count_user = count($user);
        // $covid = CovidApi::get_all_data_from_day(30);
        $countsms = count(LogSmsEmail::where('type',true)->get()->toArray());
        $countemail = count(LogSmsEmail::where('type',false)->get()->toArray());
        $total_price = $countsms * 0.175;
        return view('home', [
            'logg' => $log,
            'calendar' => $calendar,
            'phongban' => $phongban, 
            'chucvu' => $chucvu,
            'user' => $count_user,
            'user_avtive' => $count_active,
            'count_sms' => $countsms,
            'count_email' => $countemail,
            'total_price' => $total_price,
            ]);
    }

    public function covid_api(Request $request){
        $lastday = $request->input('last_day');
        $covid = CovidApi::get_all_data_from_day($lastday);
        return \Response()->json($covid);
    }
}
