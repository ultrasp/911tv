<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Hash;

class MenuController extends Controller
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
        $menus = Menu::all();
        return view('admin.menu.index',['menus'=>$menus]);
    }

    public function add(){
        $menu = new Menu();
        return view('admin.menu.add',['menu'=>$menu]);
    }

    public function edit($id){
        $menu = Menu::find($id);
        return view('admin.menu.edit',['menu'=>$menu]);
    }

    public function save(Request $request, $id = null){
        $request->validate(Menu::$rules);

        $menu = (is_null($id)) ? new Menu() : Menu::find($id);

        $menu->fill($request->input());
        $menu->save();
        $message = (empty($id)) ? 'Added Successfully!' : 'Updated Successfully!';
        return redirect()->route('admin.menu.index')->with('success', $message);;
    }

    public function delete($id){
        $feature = Menu::where('id',$id)->firstOrFail();
        $feature->delete();
        return redirect()->back()->with('success','Deleted Successfully!');
    }

}
