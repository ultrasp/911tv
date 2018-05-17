<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Tarif;
use App\Models\Post;
use App\Models\Platform;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Setting;
use App\Models\Program;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::all();
        $specialchannels = Channel::has('tarifs')->get();;
        return view('front.home',['channels' => $channels, 'specialchannels' =>$specialchannels]);
    }

    public function online(){
        return view('front.online');
    }

    public function about_partner(){
        return view('front.about_partner');
    }

    public function platform($slug = null){
        $platform = (!is_null($slug)) ? Platform::where('slug', $slug)->first() : null;
        return view('front.platform',['cur_platform' => $platform]);
    }

    public function enter($token){
        $user = User::where('recover_token', $token)->first();
        if($user){
            Auth::login($user);
            $user->recover_token =  null;
            $user->save();
            return redirect()->route('front.cabinet');
        }
        return redirect()->route('front.home');
    }

    public function api(){
    	$users = User::get();
    	$log  = "Api started: ".date("Y-m-d H:i:s")."\r\n";
	    //file_put_contents('./test.log', $log, FILE_APPEND);

    	foreach ($users as $user) {
        	\App\Models\UserChannel::makeApiUrl($user->id, false);
    	}
    	$log  .= "Api finished: ".date("Y-m-d H:i:s")."\r\n";
	    file_put_contents(base_path('/test.log'), $log, FILE_APPEND);
    }

    public function updateApi(){
        $panel_url = 'http://topchantv.net:3456/';
        $username = 'topchantv.net';
        
        $setting = Setting::first();
        //dd($setting);  
		///$password  = '5kvc499B';
        $password = $setting->api_password;

        //$password = file_get_contents('api_pasword');
        $new_password = str_random(8);
        //$setting->api_password = '5kvc499B';
        $setting->api_password = $new_password; 
        echo($new_password);
        $post_data = [
            'username' => $username,
            'password' => $password,
            'user_data' => [
                'password' => $new_password 
            ]
        ];

        $opts = array( 'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query( $post_data ) ) );

        $context = stream_context_create( $opts );
        $api_result = json_decode( file_get_contents( $panel_url . "api.php?action=user&sub=edit", false, $context ) );
        var_dump($api_result);
        if($api_result->result){
            $setting->save();
            $this->onplaylist();
        }
    }

    public function onplaylist(){
        $items = [
            [
                "comment" => "TOP Vostok",
                "poster" => "http://topchantv.net/wp-content/themes/divantv/uppod/img/vostok.png",
                'id' => 6
            ],
            [
                "comment" => "TOP 80",
                "poster" => "http://topchantv.net/wp-content/themes/divantv/uppod/img/80.png",
                'id' => 277,
            ],
            [
                "comment" => "TOP Music",
                "poster" => "http://topchantv.net/wp-content/themes/divantv/uppod/img/topmosic.png",
                'id' => 1666,
            ],
            [
                "comment" => "TOP CinemaHD",
                "poster" => "http://topchantv.net/wp-content/themes/divantv/uppod/img/power.jpg",
                'id' => 1611,
            ]
        ];
        $setting = Setting::first();
        $username = 'topchantv.net';
        foreach ($items as $key => $item) {
            $items[$key]['file'] = 'http://topchantv.net:3456/live/'.$username.'/'.$setting->api_password.'/'.$item['id'].'.m3u8'; 
        }
        $json_a = ['playlist' => $items];
        file_put_contents('js/playlist_video223.txt', json_encode($json_a));
        //return response()->json();
    }

    public function test(){
        Program::parse_url();
    }
}

