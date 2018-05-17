<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Support\Facades\Hash;

class FeedbackController extends Controller
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

    public function index(){
        $chatters = Feedback::where('user_id' , '<>',Feedback::USER_ADMIN)->has('sender')
        ->orderBy('created_at', 'desc')
        ->groupBy('user_id')
        ->get();
        return view('admin.feedback.index',['chatters'=>$chatters]);
    }

    public function chat($user_id){
        $chat = Feedback::where('user_id' , $user_id)->orwhere('receiver' , $user_id)->get();
        return view('admin.feedback.chat',['chat'=>$chat,'user_id' => $user_id]);
    }

    public function save(Request $request, $user_id = null){
        $ask = new Feedback();
        $ask->message = $request->input('message');
        $ask->user_id = Feedback::USER_ADMIN;
        $ask->receiver = $user_id;
        $ask->save();
        return response()->json(['html' => view('admin.feedback.message',['message' => $ask])->render()]);
    }

    public function delete($id){
        Feedback::where('user_id',$id)->orwhere('receiver', '=',$id)->delete();
        return redirect()->back()->with('success','Chat deleted Successfully!');
    }

    public function delete_message($id){
        $message = Feedback::where('id',$id)->firstOrFail();
        $message->delete();
        return redirect()->back()->with('success','Message Deleted Successfully!');
    }

}
