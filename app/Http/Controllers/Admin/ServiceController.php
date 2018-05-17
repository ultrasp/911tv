<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;

class ServiceController extends Controller
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
        $services = Service::all();
        return view('admin.services.index',['services'=>$services]);
    }

    public function add(){
        $service = new Service();
        return view('admin.services.add',['service'=>$service]);
    }

    public function edit($id){
        $service = Service::find($id);
        return view('admin.services.edit',['service'=>$service]);
    }

    public function save(Request $request, $id = null){
        $request->validate(Service::$rules);

        $service = (is_null($id)) ? new Service() : Service::find($id);

        $service->fill($request->input());
        $service->save();
        $message = (empty($id)) ? 'Added Successfully!' : 'Updated Successfully!';
        return redirect()->route('admin.service.index')->with('success', $message);;
    }

    public function delete($id){
        $service = Service::where('id',$id)->firstOrFail();
        $service->delete();
        return redirect()->back()->with('success','Deleted Successfully!');
    }

}
