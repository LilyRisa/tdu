<?php
namespace App\Jobs;
use Config;
use App\Models\User;
use Illuminate\Support\Facades\Http;


class FaceRecogn {

    protected $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function set_face_recogn(){
        $response = $this->set_face_recogn_cloud();
        return $response;
    }

    public static function get_username_with_image($url_photo){
        $response = self::PostField(null,$url_photo,false);
        return $response;
    }

    private function set_face_recogn_cloud(){
        $response = self::PostField($this->user->username, asset('storage').'/'.$this->user->avatar);
        $response = json_decode($response, true);
        return $response;
    }

    private static function PostField($name = null, $photo, $recogn = true){
        
        if($recogn){
            $url = "https://api.luxand.cloud/subject/v2";
            $arr = ["photo" => curl_file_create($photo)];
        }else{
            $url = "https://api.luxand.cloud/photo/search";
            $arr = ["photo" => $photo];
        }
        if($name != null){
            $arr['name'] = $name; 
            $arr['store'] = '1';
        }
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $arr, 
            CURLOPT_HTTPHEADER => array(
                "token: ".Config('app.FaceRecogn_token')
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}