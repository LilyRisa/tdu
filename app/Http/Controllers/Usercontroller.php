<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Session\Middleware\StartSession;
use Auth;

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

    public function list(){
        $user = User::all();
        return view('account_list',['user'=>$user]);
    }

    public function contact(){
        $user = User::all();
        return view('contact',['user'=>$user]);
    }
}
