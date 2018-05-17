<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Support\Facades\Hash;

class ChannelController extends Controller
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
        $channels = Channel::all();
        return view('admin.channels.index',['channels'=>$channels]);
    }

    // public function edit($id){
    //     $client = Client::where('id',$id)->firstOrFail();
    //     return view('admin.clients.edit',['client'=>$client]);
    // }

    public function add(){
        $channel = new Channel();
        return view('admin.channels.add',['channel'=>$channel]);
    }

    public function edit($id){
        $channel = Channel::find($id);
        return view('admin.channels.edit',['channel'=>$channel]);
    }

    public function save(Request $request, $id = null){
        $request->validate(Channel::$rules);
        //dd($request->input());

        $channel = (is_null($id)) ? new Channel() : Channel::find($id);

        $image = $request->file('img');
        if(!empty($image)){
            $filename = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)
                //->fit(300, 300)
                ->save( public_path(Channel::$folder . $filename ) );
        }else{
            if(empty($id)){
                $filename = 'nopic.png';
            }else{
                $filename = $channel->img;
            }
        }
        $channel->fill($request->input());
        $channel->img = $filename;
        $channel->save();
        $message = (empty($id)) ? 'Added Successfully!' : 'Updated Successfully!';
        return redirect()->back()->with('success', $message);;
    }

    public function delete($id){
        $channel = Channel::where('id',$id)->firstOrFail();
        $channel->delete();
        return redirect()->back()->with('success','Deleted Successfully!');
    }

}
