<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TestUser extends Model
{

    protected $table = "test_to_user";

    protected $fillable = ['user_id','end_time'];

    public $timestamps = false;

    public static function set_testing($user){
        if( Topchantv::makeApiUrl($user) ){
            $test = self::where(['user_id' => $user->id])->first();
            if( is_null($test) ){
                $test = new self();
                $test->user_id = $user->id;
                $test->end_time = date('Y-m-d H:i:s',strtotime('+ 3 hours'));
                $test->save();
            }
        }
    }

}
