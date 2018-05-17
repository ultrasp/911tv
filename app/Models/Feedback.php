<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class Feedback extends Model
{
	const USER_ADMIN = 'admin';

    protected $table = "feedback";

    protected $fillable = ['message','user_id','receiver'];

    public static $rules = [
    	'message' => 'required',
    ];

    public function sender(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function sendername(){
    	if($this->user_id == self::USER_ADMIN) return 'Администратор сайта';
		return (Auth::id() == $this->user_id ) ? Auth::user()->username : $this->sender->username;
    }

    public function send_telegram(){
        $bot_token = '556072817:AAHN89MAUNcej-VFFuygaIyISpxpzXb5wGo';
        $chat_id = '-285588888';
        $text = 'Вопрос '.Auth::user()->username.': '.$this->message; 
        $client = new Client();
        $client->request('GET', 'https://api.telegram.org/bot'.$bot_token.'/sendMessage', [
            'query' => ['chat_id' => $chat_id,'text'=> $text]
        ]);
    }

}
