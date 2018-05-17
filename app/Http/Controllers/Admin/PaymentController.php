<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
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
        $transactions = Payment::with('order')->has('order')->orderBy('updated_at','desc')->get();
        //dd($transactions);
        return view('admin.payment.index',['transactions'=>$transactions]);
    }
}
