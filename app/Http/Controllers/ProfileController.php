<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Carbon\Carbon;
use Storage;

class ProfileController extends Controller
{
    public function index(Request $request, $id){
        $user = User::where('username',$id)->first();
        return view('profile',['user' => $user]);
    }
    public function avatar(Request $request){
        $image = $request->input('avatar');

        // $image = str_replace('data:image/png;base64,', '', $file);
        // $image = str_replace(' ', '+', $image);
        $image = explode( ',', $image);
        $image = $image[1];

        $imageName = md5(Carbon::now()->timestamp) . '.png';
        $path = 'image/'.$imageName;
        Storage::disk('local')->put($path, base64_decode($image));
        $user = User::where('username',$request->session()->get('user_username'))->first();
        $user = User::find($user->id);
        $user->avatar = $path;
        $user->save();
        Session(['avatar'=> $path]);
        return response()->json(['source' => $path, 'is' =>true]);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->address = $request->input('address');
        $user->description = $request->input('description');
        $user->phone = $request->input('phone');
        $user->save();
        return response()->json(['is' =>true]);
    }
}
