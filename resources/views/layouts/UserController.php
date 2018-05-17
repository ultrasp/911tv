<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Models\UserChannel;

class UserController extends Controller
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
    public function check_email(Request $request)
    {
        if( is_null($request->input('email',null)) ){
            return 0;
        }else{
            return (User::where('email',$request->input('email'))->exists()) ? 0 : 1;
        }
    }

    public function register(Request $request){
        $request->validate([
            'user_mail' => 'required|unique:users,email|email',
            'user_name' => 'required|string|min:2',
            'user_pass'  => 'required|string|same:user_pass2',
            'user_pass2' => 'required',
            'g-recaptcha-response' => 'required'
        ]);

        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $secret = '6Le6JUMUAAAAAOljMxe_IvNTwM8X62Q52tCECP9i';

        $client = new Client(); 
        $response = $client->request('POST',$recaptcha_url, [
            'form_params' => [
                'secret' => $secret,
                'response' => $request->input('g-recaptcha-response')
            ]
        ]);

        $resp = json_decode($response->getBody());
        if(!$resp->success){
            return 0;
        }
        $user = new User();
        $user->email_activate_token = str_random();
        $user->username = $request->input('user_name');
        $user->email = $request->input('user_mail');
        $user->password = bcrypt($request->input('user_pass'));
        $user->partner_code = Str::random(5);
        $user->account_status = User::A_STAUS_INACTIVE;
        $user->boss_parent_id = $request->input('partner_id',null);
        $user->save();
        $user->sendMail();
        Auth::login($user);
        return 1;
    }

    public function recover(Request $request){
        $request->validate([
            'user_mail' => 'required|email',
            'g-recaptcha-response' => 'required'
        ]);

        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $secret = '6Ld0nUQUAAAAAJ4qUI-xCH63H2dWehfh8yG4T4At';

        $client = new Client(); 
        $response = $client->request('POST',$recaptcha_url, [
            'form_params' => [
                'secret' => $secret,
                'response' => $request->input('g-recaptcha-response')
            ]
        ]);

        $resp = json_decode($response->getBody());
        if(!$resp->success){
            return response()->json(['error' => 'Не пройден проверка анти бота ']);
        }

        $user = User::where('email', $request->input('user_mail'))->first();
        if(is_null($user)){
            return response()->json(['error' => 'Пользователь с такой электронной почтой в базе данных нет ']);
        }
        $user->recover_token = Str::random(30);
        $user->save();
        $user->sendRecoverMail();
        return 1;
    }

    public function logout(){
        Auth::logout();
        return back();
    }

    public function cabinet(){
        $user = Auth::user();
        $user_channels = UserChannel::where('end_time','>',date('Y-m-d') )
                            ->where('user_id', $user->id)
                            ->get();
        return view('front.cabinet',['user' => $user,'user_channels' => $user_channels]);
    }

    public function save_ask(Request $request){
        if(Auth::check()){
            $request->validate(Feedback::$rules);
            $ask = new Feedback();
            $ask->message = $request->input('message');
            $ask->user_id = Auth::id();
            $ask->receiver = Feedback::USER_ADMIN;
            $ask->save();
        }else{
            return 'NOT AUTHORIZED';
        }
    }

    public function change_status($up = null){
        if(is_null($up) ){
            Auth::user()->makeInactive();
        }else{
            Auth::user()->makeActive();
        }
        return back();
    }

    public function profile(Request $request){
        $rules = [
            'username' => 'required|string|min:3',
            'password' => 'required|string|min:3|confirmed',
        ];
        $request->validate($rules);
        $user = Auth::user();
        $user->fill($request->except('email'));
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return back()->with('message','Ваши данные успешно изменены');
    }

    public function adult_password(Request $request){
        $request->validate(['code' => 'required|digits:4']);
        $user = Auth::user();
        $user->channels_code = $request->input('code');
        $user->save();
        return 1;
    }

    public function approv($token){
        $user = User::where('email_activate_token',$token)->first();
        if(is_null($user)) return redirect()->route('front.home');
        $user->email_activate_token = null;
        $user->save();
        Auth::login($user);
        return redirect()
                    ->route('front.cabinet')
                    ->with('message','Ваши учетный запись потверждена');
    }

    public function send_mail(){
        $user = Auth::user();
        $user->sendMail();
        return 1;
    }

    public function help(){
        $user_id = Auth::id();
        $old_messages = Feedback::where('user_id',$user_id)->orWhere('receiver', $user_id)->orderBy('created_at','desc')->get();
        return view('front.help',['old_messages' => $old_messages]);
    }

    public function save_message(Request $request){
        $request->validate(Feedback::$rules);
        $message = new Feedback();
        $message->message = $request->input('message');
        $message->user_id = Auth::id();
        $message->receiver = Feedback::USER_ADMIN;
        $message->save();
        return response()->json([
            'message' => view('front.message',['message' => $message])->render(),
        ]);
    }

    public function playlist(){
        if(!Auth::check()){
            return 0;
        }else{
            //m3u&output=
            return 'http://topchantv.net:3456/get.php?username='.Auth::user()->username.'&password='.Auth::user()->api_password.'&type=';
        }
    }
}
