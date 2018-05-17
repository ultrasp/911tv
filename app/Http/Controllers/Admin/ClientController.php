<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
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
        $clients = Client::all();
        return view('admin.clients.index',['clients'=>$clients]);
    }

    public function edit($id){
        $client = Client::where('id',$id)->firstOrFail();
        return view('admin.clients.edit',['client'=>$client]);
    }

    public function save(Request $request, $id){
        $request->validate(Client::$rules);
        //dd($request->input());
        $client = Client::find($id);
        $client->fill($request->input());
        $client->save();
        return redirect()->back()->with('success', 'Updated Successfully!');;
    }

    public function delete($id){
        $client = Client::where('id',$id)->firstOrFail();
        $client->delete();
        return redirect()->back()->with('success','Deleted Successfully!');
    }

}
