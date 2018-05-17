<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tarif;
use Illuminate\Support\Facades\Hash;

class TarifController extends Controller
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
        $tarifs = Tarif::all();
        return view('admin.tarif.index',['tarifs'=>$tarifs]);
    }

    public function add(){
        $tarif = new Tarif();
        return view('admin.tarif.add',['tarif'=>$tarif]);
    }

    public function edit($id){
        $tarif = (!is_null($id)) ? Tarif::where('id',$id)->firstOrFail() : new Tarif();
        return view('admin.tarif.edit',['tarif'=>$tarif]);
    }

    public function save(Request $request, $id=null){
        $request->validate(Tarif::$rules);
        $plan = (!is_null($id)) ? Tarif::where('id',$id)->firstOrFail() : new Tarif();
        $plan->fill($request->input());
        $plan->save();
        $message = (!is_null($id)) ? 'Updated Successfully!' : 'Added';
        return redirect()->route('admin.tarif.index')->with('success', $message);
    }

    public function delete($id){
        $plan = Tarif::where('id',$id)->firstOrFail();
        $plan->delete();
        return redirect()->back()->with('success','Deleted Successfully!');
    }

}
