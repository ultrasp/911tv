<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Support\Facades\Hash;

class FeatureController extends Controller
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
        $features = Feature::all();
        return view('admin.features.index',['features'=>$features]);
    }

    public function add(){
        $feature = new Feature();
        return view('admin.features.add',['feature'=>$feature]);
    }

    public function edit($id){
        $feature = Feature::find($id);
        return view('admin.features.edit',['feature'=>$feature]);
    }

    public function save(Request $request, $id = null){
        $request->validate(Feature::$rules);

        $feature = (is_null($id)) ? new Feature() : Feature::find($id);

        $feature->fill($request->input());
        $feature->save();
        $message = (empty($id)) ? 'Added Successfully!' : 'Updated Successfully!';
        return redirect()->route('admin.feature.index')->with('success', $message);;
    }

    public function delete($id){
        $feature = Feature::where('id',$id)->firstOrFail();
        $feature->delete();
        return redirect()->back()->with('success','Deleted Successfully!');
    }

}
