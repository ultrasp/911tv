<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Tarif;
use Illuminate\Support\Facades\Auth;
use App\Plugins\Interkassa;
use App\Models\Payment;
use App\Models\Finance;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.payment');
    }

    public function service($provider){
        
    }

    public function addcart(Request $request){
        if(is_null($request->input('id'))){
            return 'Выберите товар для добавление в корзину';
        }
        $user_id = Auth::id();
        $cart = Order::getCart($user_id);
        $item = Tarif::find($request->input('id'));
        $cart->addItem($item);
        //$cart->save();
        return 1;
    }

    public function delete_from_cart($id){
        $cart = Order::getCart(Auth::id());
        $cart->removeItem($id);
        return response()->json([
            'price' => $cart->amount,
            'free_sign' => $cart->getFreekassaSign(),
            'payeer_sign' => $cart->getPayeerSign()
        ]);
    }

    public function cart(){
        $cart = Order::getCart(Auth::id());
        return view('front.cart',['cart' => $cart]);
    }

    private function getIP() {
    if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
        return $_SERVER['REMOTE_ADDR'];
    }

    public function payed(Request $request){
        /*if (!in_array($this->getIP(), array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189', '88.198.88.98','162.158.90.142'))) {
            die($this->getIP()." hacking attempt!");
        }*/
        $merchant_id = config('payment.freekassa.merchant_id');
        $merchant_secret = config('payment.freekassa.secret_word2');

        $sign = md5($merchant_id.':'.
                    $request->input('AMOUNT').':'.
                    $merchant_secret.':'.
                    $request->input('MERCHANT_ORDER_ID'));
        if ($sign != $request->input('SIGN')) {
            die('wrong sign');
        }
        $order = Order::find($request->input('MERCHANT_ORDER_ID'));
        if(is_null($order)){
            die('not exists order');   
        }
        if($order->isPayed()){
            die('order already payed');    
        }
        if($order->amount != $request->input('AMOUNT')){
            die('amount error');   
        }
        $order->savePayed($request, Payment::SERVICE_FREEKASSA);
        die('YES');
    }

    public function payed2(Request $request){
        $merchant_id = config('freekassa.interkassa');
        $merchant_secret = config('payment.interkassa.secret_key');

        if($request->input('ik_co_id') != $merchant_id){
            return false;
        }

        $data = [];
        foreach ($request->input() as $key => $value)
        {
            if (!preg_match('/ik_/', $key))
            continue;
            $data[$key] = $value;
        }

        $ik_sign = $data['ik_sign'];
        unset($data['ik_sign']);

        ksort($data, SORT_STRING);
        array_push($data, $merchant_secret);
        $signString = implode(':', $data);
        $sign = base64_encode(md5($signString, true));

        if ($sign === $ik_sign ){
            if($data['ik_inv_st'] == 'success'){
                $order = Order::find($request->input('ik_pm_no'));
                if(is_null($order)){
                    return false;
                }
                if($order->amount != $request->input('ik_am')){
                    return false;   
                }
                $order->savePayed($request, Payment::SERVICE_INTERKASSA);

                return true;
            }
            return false;
        }else{
             return false;
        }
    }

    public function success(){
        session(['message_type' => 'success']);
        return redirect()->route('front.cabinet')->with('message','Оплата прошло успешно');
    }

    public function fail(){
        session(['message_type' => 'error']);
        return redirect()->route('front.cabinet')->with('message','Оплата отменена');
    }

    public function history(){
        $finances = Finance::where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        return view('front.history',['finances' => $finances]);
    }

    public function goToPayment(){
        if(Auth::check()){
            return route('front.cart');
        }else{
            return 1;
        }
    }
}
