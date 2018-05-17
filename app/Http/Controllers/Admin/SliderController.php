<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\Hash;

class SliderController extends Controller
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
        $slides = Slider::all();
        return view('admin.slider.index',['slides'=>$slides]);
    }

    public function add(){
        $slide = new Slider();
        return view('admin.slider.add',['slide'=>$slide]);
    }

    public function edit($id){
        $slide = Slider::find($id);
        return view('admin.slider.edit',['slide'=>$slide]);
    }

    public function save(Request $request, $id = null){
        $request->validate(Slider::$rules);

        $slide = (is_null($id)) ? new Slider() : Slider::find($id);

        $slide->saveItem($request);
        $message = (empty($id)) ? 'Added Successfully!' : 'Updated Successfully!';
        return redirect()->route('admin.slide.index')->with('success', $message);;
    }

    public function delete($id){
        $slide = Slider::where('id',$id)->firstOrFail();
        $slide->delete();
        return redirect()->back()->with('success','Deleted Successfully!');
    }

}
