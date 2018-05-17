<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
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
        $members = Team::all();
        return view('admin.team.index',['members'=>$members]);
    }

    public function add(){
        $person = new Team();
        return view('admin.team.add',['person'=>$person]);
    }

    public function edit($id){
        $person = Team::find($id);
        return view('admin.team.edit',['person'=>$person]);
    }

    public function save(Request $request, $id = null){
        $request->validate(Team::$rules);

        $person = (is_null($id)) ? new Team() : Team::find($id);

        $person->saveItem($request->input());
        $message = (empty($id)) ? 'Added Successfully!' : 'Updated Successfully!';
        return redirect()->route('admin.team.index')->with('success', $message);;
    }

    public function delete($id){
        $feature = Feature::where('id',$id)->firstOrFail();
        $feature->delete();
        return redirect()->back()->with('success','Deleted Successfully!');
    }

}
