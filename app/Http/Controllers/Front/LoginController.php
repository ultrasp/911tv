<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;

class LoginController extends Controller {

   public function doLogin(Request $request)
    {

        // validate the info, create rules for the inputs
        $rules = array(
            'user_mail'    => 'required|email', // make sure the email is an actual email
            'user_pass' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );
        $request->validate($rules);

        // create our user data for the authentication
        $userdata = array(
            'email'     => $request->input('user_mail'),
            'password'  => $request->input('user_pass')
        );

        // attempt to do the login
        if (Auth::attempt($userdata)) {

            return response()->json([
                'name' => Auth::user()->username,
                'playlist' => '<a style="cursor:pointer" class="tt-s-20 tt-l-22 tt-w-7" id="playlist_link" href="http://topchantv.net:3456/get.php?username='.Auth::user()->username.'&password='.Auth::user()->api_password.'&type=m3u&output=ts">Скачать плейлист</a>'
            ]);

        } else {
            return 0;

        }

    }

}