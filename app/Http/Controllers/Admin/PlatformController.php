<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Platform;

class PlatformController extends Controller
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
        $platforms = Platform::all();
        return view('admin.platform.index',['platforms'=>$platforms]);
    }

    public function add(){
        $platform = new Platform();
        return view('admin.platform.add',['platform'=>$platform]);
    }

    public function edit($id){
        $platform = Platform::find($id);
        return view('admin.platform.edit',['platform'=>$platform]);
    }

    public function save(Request $request, $id = null){
        $request->validate(Platform::$rules);
//        dd($request->input());
        $platform = (is_null($id)) ? new Platform() : Platform::find($id);

        $platform->name = $request->input('name');
        $platform->os = $request->input('os');
        $platform->dop_info = $request->input('dop_info');
        $platform->save();
        $platform->renderContent($request->input('content'));
        $platform->saveTypes($request->input('type'));
        $platform->slug = $platform->id.'_'.str_slug($platform->name);
        $platform->save();
        $message = (empty($id)) ? 'Added Successfully!' : 'Updated Successfully!';
        return redirect()->back()->with('success', $message);;
    }

    public function delete($id){
        $platform = Platform::where('id',$id)->firstOrFail();
        $platform->delete();
        return redirect()->back()->with('success','Deleted Successfully!');
    }

}
