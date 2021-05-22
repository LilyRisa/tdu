<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FaceRecognModel;
use App\Jobs\FaceRecogn;
use Session;
use Auth;
use Carbon\Carbon;
use Storage;

class FaceRecognModelController extends Controller
{
    public function index(){
        $detect = FaceRecognModel::where('user_id',Auth::id())->first();
        if($detect){
            $face = FaceRecogn::get_list_person();
            $user = User::find(Auth::id());
            $key = array_search($user->username, array_column($face, 'name'));
            $face = $face[$key];
            return view('face_recogn',['user' => $user, 'face' => $face]);
        }       
        return redirect()->route('face.createper');
        
    }

    public function create_person(){
        $user = User::find(Auth::id());
        $detect = FaceRecognModel::where('user_id',Auth::id())->first();
        if($detect){
            return redirect()->route('face.index');
            
        }   
        return view('face_recogn_create_person', ['user' => $user]);
    }

    public function create_person_post(Request $request){
        $image = $request->input('avatar');
        $image = explode( ',', $image);
        $image = $image[1];
        $imageName = md5(Carbon::now()->timestamp) . '.png';
        $path = 'image/'.$imageName;
        Storage::disk('local')->put($path, base64_decode($image));
        $user = User::find(Auth::id());
        $face = new FaceRecogn($user);
        $response = $face->create_person_cloud_with_photo($path);

        if(isset($response['error'])){
            return response()->json(['is' =>false]);
        }
        $face_detected = new FaceRecognModel();
        $face_detected->user_id = Auth::id();
        $face_detected->id_cloud = $response['id'];
        $face_detected->save();
        return response()->json(['is' =>true]);
    }

    public function post(Request $request){
        $image = $request->input('avatar');
        $image = explode( ',', $image);
        $image = $image[1];
        $imageName = md5(Carbon::now()->timestamp) . '.png';
        $path = 'image/'.$imageName;
        Storage::disk('local')->put($path, base64_decode($image));
        $user = User::where('id', Auth::id())->with('FaceRecognModel')->first();
        $arr = ["photo" => asset('storage').'/'.$path, "id" => $user->FaceRecognModel->id_cloud];
        $face = FaceRecogn::add_face_to_person_username($arr);
        Storage::disk('local')->delete($path);
        return response()->json(['source' => $face, 'is' =>true]);
    }

    public function detect(Request $request){
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
                return response()->json(['is' => true, 'messenge' => $user]);
            }
            return response()->json(['is' => false, 'messenge' => 'Không nhận diện được nhân viên nào']);
        }
        return response()->json(['is' => false, 'messenge' => 'Không nhận diện được nhân viên nào']);
    }
}
