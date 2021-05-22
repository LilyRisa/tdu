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
    public function set_face_recogn_with_image($photo){
        $response = $this->set_face_recogn_cloud($photo);
        return $response;
    }

    public static function get_username_with_image($url_photo){
        $response = self::PostField(null,$url_photo,false);
        return $response;
    }

    public static function get_list_person(){
        $response = self::FactoryUser();
        return $response;
    }

    public static function add_face_to_person_username($arr){ // $array = ["photo" => {url_photo}, "id" => {id_cloud}]
        $response = self::FactoryUser($arr);
        return $response;
    }

    public function create_person_cloud_with_photo($photo){
        $response = self::PostField($this->user->username, asset('storage').'/'.$photo);
        $response = json_decode($response, true);
        return $response;
     }

    private function set_face_recogn_cloud($photo = null){
        if($photo == null){
            $response = self::PostField($this->user->username, asset('storage').'/'.$this->user->avatar);
            $response = json_decode($response, true);
            return $response;
        }else{
            $response = self::PostField($this->user->username, $photo);
            $response = json_decode($response, true);
            return $response;
        }
        
    }

    private static function FactoryUser($arr = null){ //return array
        if($arr == null){
            $method = 'GET';
            $payload = [];
            $id = null;
        }else{
            $method = 'POST';
            $payload = [ "store" => "1", "photo" => curl_file_create($arr['photo'])];
            $id = '/'.$arr['id'];
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.luxand.cloud/subject".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $payload, 
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
            return json_decode($response, true);
        }
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
            return ['messenge' => "cURL Error #:" . $err, 'error' => true];
        } else {
            return $response;
        }
    }
}