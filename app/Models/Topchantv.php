<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Topchantv 
{

    const PROVIDER = 'http://topchantv.net:3456/';

    const TEST_PLEYLIST_ID = 62;

    public static function makeApiUrl($user){

//        $action = is_null($user->api_password) ?  'create' : 'edit'; 
        $is_create = is_null($user->api_password) ?  true : false; 

        if( !$is_create ) {
            $is_create = !self::check_is_active($user);
        }

        $action = $is_create  ?  'create' : 'edit'; 


        $new_password = str_random(8);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
        if( $is_create ){
            $post_data = [
            'user_data' => [
                'username' => $user->username,
                'max_connections' => 1,
                'is_restreamer' => 0,
                'member_id'  => 20,
                'exp_date' => strtotime( '+3 hours' ),
                'bouquet' => json_encode( [self::TEST_PLEYLIST_ID] )
            ]
        ];

        }else{
            $post_data =  [
                'username' => $user->username,
                'password' => $user->api_password,
                'user_data' => ['password' => $new_password]
            ];
        }

        $opts = array( 'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query( $post_data ) ) );
        $context = stream_context_create( $opts );
        $api_result = json_decode( file_get_contents( self::PROVIDER . "api.php?action=user&sub=".$action, false, $context ) );
        
        var_dump($api_result);
        if( $api_result->result ){
            //dd($api_result);
            if($is_create){
                $user->api_id = $api_result->created_id;
            }
            $user->api_password =$api_result->password;
            $user->save();
        }

        return $api_result->result;
    }

    public static function check_is_active($user){
        $post_data = [
                'username' => $user->username, 
                'password' => $user->api_password 
            ];
        
        $opts = array( 'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query( $post_data ) ) );

        $context = stream_context_create( $opts );
        
        $api_result = json_decode( file_get_contents( self::PROVIDER . "api.php?action=user&sub=info", false, $context ), true );

        return $api_result['result']; //true if has in system
    }

    /*
    public static function get_pleylist_url($user){

        $test = self::first();

        if( is_null($test) ){
            $test = self::makeApiUrl();
        }

        return self::PROVIDER.'get.php?username='.$user->username.'&password='.$user->api_password.'&type=m3u&output=ts';
    }
    */
}
