<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\chucvu;
use App\Models\phongban;
use Illuminate\Session\Middleware\StartSession;
use Auth;
use App\Jobs\SendEmail;
use App\Jobs\FaceRecogn;
use Carbon\Carbon;
use App\Models\LogSmsEmail;
use Storage;

class Usercontroller extends Controller
{
    public function register(Request $request){
        $state = ['is' => true, 'messege' => ''];
        try{
            $user = new User();
            $user->fill($request->all());
            $user->start_contract = date("Y-m-d H:i:s",strtotime($request->input('start_contract')));
            $user->password = Hash::make($request->input('password'));
            $user->save();
            $state['messege'] = 'success';
        }catch(\Exception $e){
            $state['messege'] = $e;
            $state['is'] = false;
        }
        return response()->json($state);
    }
    public function login(Request $request){
        // $password = Hash::make($request->input('password'));
        $user = User::where('username', $request->input('username'))->first();
        if(Hash::check($request->input('password'), $user->password)){
            Auth::attempt(['username' => $user->username, 'password' => $request->input('password'), 'isAdmin' => $user->isAdmin]);
            session(['user_username' => $user->username, 'level' => $user->isAdmin, 'avatar' => $user->avatar, 'fullname' => $user->fullname, 'email' => $user->email]);
            return response()->json(['is' => true]);
            
        }
        return response()->json(['is' => false]);
    }

    public function loginFace(Request $request){
        $image = $request->input('avatar');
        $image = explode( ',', $image);
        $image = $image[1];
        $imageName = md5(Carbon::now()->timestamp) . '.png';
        $path = 'image/'.$imageName;
        Storage::disk('local')->put($path, base64_decode($image));
        $path = asset('storage').'/'.$path;
        $return = FaceRecogn::get_username_with_image($image);
        Storage::disk('local')->delete($path);
        $return = json_decode($return, true);
        if(!empty($return)){
            $return = $return[0];
            $username = $return['name'];
            $user = User::where('username', $username)->first();
            if($user != null){
                Auth::loginUsingId($user->id);
                session(['user_username' => $user->username, 'level' => $user->isAdmin, 'avatar' => $user->avatar, 'fullname' => $user->fullname, 'email' => $user->email]);
                return response()->json(['is' => true, 'messenge' => $user]);
            }

            return response()->json(['is' => false, 'messenge' => 'Không nhận diện được nhân viên nào']);
        }

        return response()->json(['is' => false, 'messenge' => 'Không nhận diện được nhân viên nào']);
    }

    public function list(){
        $user = User::with('chucvu')->with('phongban')->get();
        $chucvu = chucvu::all();
        return view('account_list',['user'=>$user, 'chucvu'=>$chucvu]);
    }

    public function contact(){
        $user = User::all();
        return view('contact',['user'=>$user]);
    }

    public function GetPhongBanWithChucVu(Request $request){
        $pb = phongban::where('chucvu_id',$request->input('chucvu_id'))->get();
        return response()->json(['phongban' => $pb]);
    }

    public function GetChucVu(Request $request){
        $cv = chucvu::where('id',$request->input('id'))->first();
        return response()->json(['chucvu' => $cv]);
    }

    public function GetPhongBan(Request $request){
        $pb = phongban::where('id',$request->input('id'))->first();
        return response()->json(['phongban' => $pb]);
    }

    public function ActiveUser(Request $request){
        $user = User::find($request->input('id'));
        $user->isActive = 1;
        $user->	chucvu_id = (int)$request->input('chucvu');
        $user->	phongban_id = (int)$request->input('phongban');
        $user->	start_contract = date('Y-m-d H:i:s');
        $user->save();
        $user_get = User::where('id',$request->input('id'))->with('phongban')->with('chucvu')->first();
        SendEmail::dispatch($user_get, $user_get->email, [
            'title' => 'Tài khoản của bạn đang được kích hoạt vào lúc '.date('Y-m-d'),
            'body' => 'Tài khoản của bạn được kích hoạt bơi quản trị viên truy cập vào link sau để đăng nhặp lại <a href="'.route('index').'">'.route('index').'</a>',
            'image' => 'https://raw.githubusercontent.com/lime7/responsive-html-template/master/index/intro__bg.png'
            ]);
        $logg = new LogSmsEmail();
        $logg->type = false;
        $logg->save();
        return response()->json(['is' => true, 'user'=>$user_get]);
    }
}
