<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserChannel extends Model
{
    protected $fillable = ['user_id','channel_id','end_time'];
    public $timestamps = false;

    protected $table = "user_channel";

    const LOG = 'log.txt';

    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public static function saveItem($order){
    	foreach ($order->items as $key => $item) {
    		if($item->tarif){
    			$u_channel = self::firstOrNew([
    				'user_id' => $order->user_id,
    				'channel_id' => $item->tarif->channel_id,
    			]);
    			$start_time = ( strtotime($u_channel->end_time) > strtotime("now") ) ? strtotime($u_channel->end_time) : strtotime("now");
				$u_channel->end_time = date('Y-m-d H:i:s', strtotime("+".$item->tarif->period." months", $start_time));
				$u_channel->save();
    		}
    	}
    }

    public static function makeApiUrl($user_id, $is_checked = true ){
        $user = User::find($user_id);
        $action = is_null($user->api_password) ?  'create' : 'edit'; 
        $expire_date = self::where('user_id',$user->id)->max('end_time');
        $links = self::where('user_id',$user->id)->where('end_time','>=',date('Y-m-d H:i:s'))->get();
        $channel_ids = [];
        foreach ($links as $key => $link) {
            $tarif = Tarif::where( 'channel_id' ,$link->channel_id)->where('period',1)->first();
            if( !is_null($tarif)){
                array_push($channel_ids, $tarif->api_id);
            }
        }

        if(!$is_checked){
            $is_checked =  ( self::where('user_id',$user->id)->count() > 0 ) ? true : false;
        }

        if($is_checked){

            $user_data = [
                'max_connections' => 1,
                'is_restreamer' => 0,
                'member_id'  => 20,
                'exp_date' => strtotime( $expire_date ),
                'bouquet' => json_encode( $channel_ids )
            ];
            if( is_null($user->api_password )){
                $user_data['username'] = $user->username;
            }
            $post_data = [ 'user_data' => $user_data ];

            if( !is_null($user->api_password )){
                $post_data['username'] = $user->username;
                $post_data['password'] = $user->api_password;
            }

            $opts = array( 'http' => array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query( $post_data ) ) );
            $log = json_encode($post_data);
            //var_dump($post_data);
            $provider_url = 'http://topchantv.net:3456/';
            $context = stream_context_create( $opts );
            $api_result = json_decode( file_get_contents( $provider_url . "api.php?action=user&sub=".$action, false, $context ) );

            $log .= json_encode($api_result)."\n\r";
            file_put_contents(self::LOG, $log, FILE_APPEND | LOCK_EX);

            //var_dump($api_result);
            //exit();
            if($api_result->result and is_null($user->api_password)){
                $user->api_id = $api_result->created_id;
                $user->api_password = $api_result->password;
                $user->save();
            }
            if($mac = $user->mac){
                $mac->apiCall($expire_date, $channel_ids );
            }
        }
        /*   

        $post_data = array( 'username' => $user->username, 'password' => $user->api_password );
$opts = array( 'http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query( $post_data ) ) );

$context = stream_context_create( $opts );
$api_result = json_decode( file_get_contents( $provider_url . "api.php?action=user&sub=info", false, $context ), true );
*/
        //var_dump($api_result);
        
    }

    public function difDays(){
    	$datetime1 = date_create($this->end_time); 
    	$datetime2 = date_create(date('Y-m-d')); 
    	$interval = date_diff($datetime1, $datetime2); 
    	return $interval->days; 
    }
}
