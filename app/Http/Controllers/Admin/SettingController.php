<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
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
        $setting = Setting::first();
        if(empty($setting)) $setting = new Setting();
        return view('admin.setting.index',['setting'=>$setting]);
    }

    public function save(Request $request){
        $request->validate(Setting::$rules);
        //dd($request->input());
        $setting = Setting::first();
        if(empty($setting)) $setting = new Setting();
        $setting->saveItem($request);
        return redirect()->back()->with('success', 'Updated Successfully!');;
    }


}
