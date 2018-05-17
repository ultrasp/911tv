<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Hash;

class TestimonialController extends Controller
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
        $testimonials = Testimonial::all();
        return view('admin.testimonials.index',['testimonials'=>$testimonials]);
    }

    public function add(){
        $testimonial = new Testimonial();
        return view('admin.testimonials.add',['testimonial'=>$testimonial]);
    }

    public function edit($id){
        $testimonial = Testimonial::find($id);
        return view('admin.testimonials.edit',['testimonial'=>$testimonial]);
    }

    public function save(Request $request, $id = null){
        $rules = Testimonial::$rules;
        if(!empty($id)) $rules['img'] = 'image';
        $request->validate($rules);

        $testimonial = (is_null($id)) ? new Testimonial() : Testimonial::find($id);

        $testimonial->saveItem($request);
        $message = (empty($id)) ? 'Added Successfully!' : 'Updated Successfully!';
        return redirect()->route('admin.testimonial.index')->with('success', $message);;
    }

    public function delete($id){
        $testimonial = Testimonial::where('id',$id)->firstOrFail();
        $testimonial->delete();
        return redirect()->back()->with('success','Deleted Successfully!');
    }

}
