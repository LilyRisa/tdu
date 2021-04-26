<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Storage;
use App\Models\User;

class UploadController extends Controller
{
    public function index(Request $request){
        $file = $request->input('avatar');
        $image = str_replace('data:image/png;base64,', '', $file);
        $image = str_replace(' ', '+', $image);
        $imageName = md5(Carbon::now()->timestamp) . '.png';
        $path = 'image/'.$imageName;
        Storage::disk('local')->put($path, base64_decode($image));
        $user = User::get();
        return response()->json(['source' => $path]);
    }
}
