<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Macadres extends Model
{
    protected $fillable = ['mac','user_id'];

    protected $table = "mac_address";

    public function user(){
        return $this->belongsTo(User::class);
    }
    public $timestamps = false;

    public static $rules = [
    	'mac' => 'required|string'
    ];

    public function saveInApi(){
        $user = Auth::user();
        $expire_date = UserChannel::where('user_id',$user->id)->max('end_time');
        if(!is_null($expire_date)){
            $links = UserChannel::where('user_id',$user->id)->where('end_time','>=',date('Y-m-d H:i:s'))->get();
            $channel_ids = [];

            foreach ($links as $key => $link) {
                $tarif = Tarif::where( 'channel_id' ,$link->channel_id)->where('period',1)->first();
                if( !is_null($tarif)){
                    array_push($channel_ids, $tarif->api_id);
                }
            }
            return $this->apiCall($expire_date , $channel_ids);
        }else{
            return 1;
        }
    }

    public function apiCall($expire_date, $channel_ids){
        $panel_url = 'http://topchantv.net:3456/';

        $post_data = ['user_data' => [
                'mac' => $this->mac,
                'exp_date' => strtotime($expire_date),
                'bouquet' => json_encode( $channel_ids ) ],
                'max_connections' => 1,
                'is_restreamer' => 0,
                'member_id'  => 20,
            ];

        if($this->exists){
            $post_data['mac'] = $this->mac;
        }
        $action =  !$this->exists ? 'create' : 'edit';

        $opts = array( 'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query( $post_data ) ) );

        $context = stream_context_create( $opts );

        $api_result = json_decode( file_get_contents( $panel_url . "api.php?action=stb&sub=".$action, false, $context ) );
        return $api_result->result;
    }
}
