<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Channel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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

    public function dashboard(){
      $client_count = Client::count();
      $channel_count = Channel::count();
      return view('admin.dashboard',compact(
        'client_count',
        'channel_count'
      ));
    }

    public function change_pass(){
    	$user = Auth::user();
      return view('admin.change_pass',['user'=>$user]);
    }

    public function save_pass(Request $request){
        $request->validate(['username' =>'required','password' => 'required']);
        //dd($request->input());
        $user = Auth::user();
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect()->back()->with('success', 'Admin passwordUpdated Successfully!');;
    }

    public function sign_out(){
      Auth::logout();
      return redirect()->route('front.home');
    }
}
