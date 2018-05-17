<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $fillable = ['user_id','amount','currency','status'];

    const STATUS_CART = 'cart';
    const STATUS_PAYMENT_START = 'pay_start';
    const STATUS_PAYMENT_CANCEL = 'pay_cancel';
    const STATUS_PAYMENT_FINISHED = 'pay_finish';

    public function isPayed(){
        return $this->status == self::STATUS_PAYMENT_FINISHED;
    }

    public static $rules = [
    	'user_id' => 'required',
    	'amount' => 'required|numeric',
        'currency' => 'required|string'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function getCart($user_id){
        $cart = self::firstOrNew([
            'user_id' => $user_id,
            'status' => self::STATUS_CART,
             ]);
        $cart->currency = config('payment.currency');
        return $cart;
    }

    public static  function getCartCount(){
        $cart = self::where([
            'user_id' => Auth::id(),
            'status' => self::STATUS_CART,
             ])->first();
        if(is_null($cart)){
            return 0 ;
        }else{
            return $cart->items->sum('count');
        }
    }

    public function addItem($item){
        $cart_item = $this->items()->where('item_id', $item->id)->first();
        if(is_null($cart_item)){
            $cart_item = $this->makeItem($item);
        }
        $cart_item->amount_price += $item->price;
        $cart_item->count += 1;
        $this->amount += $item->price;
        $this->save();
        $this->items()->save($cart_item);
    }

    public function removeItem($id){
        $item = OrderItem::find($id);
        if($item){
            $this->amount -= $item->amount_price;
            $item->delete();
            $this->save();
        }
    }

    public function makeItem($item){
        $o_item = new OrderItem();
        //$o_item->order_id = $this->id;
        $o_item->item_id = $item->id;
        $o_item->item_price =$item->price;
        $o_item->currency = config('payment.currency');
        $o_item->amount_price = 0;
        $o_item->count = 0;
        return $o_item;
    }

    public function getFreekassaSign(){
        return md5(
            config('payment.freekassa.merchant_id').':'.
            $this->amount.':'.
            config('payment.freekassa.secret_word').':'.
            $this->id);
    }

    public function getPayeerSign(){
        $arHash = [
            config('payment.payeer.merchant_id'),
            $this->id,
            number_format($this->amount, 2, '.', ''),
            'USD',
            base64_encode('Заказ№'.$this->id),
            config('payment.payeer.secret_key')
        ];
        return strtoupper(hash('sha256', implode(':', $arHash)));
    }

    public function savePayed($request, $type){
        DB::transaction(function () use($request,$type){
                $this->status = self::STATUS_PAYMENT_FINISHED;
                $this->payment_id = Payment::saveItem($this, $request, $type);
                $this->save();
                Finance::saveItem($this->amount, $this->user_id, $this->id, 'Включение услуг по заказу', false);
                UserChannel::saveItem($this);
                UserChannel::makeApiUrl($this->user_id);
        });
        $this->sendPaymentNotify();
    }

    public function sendPaymentNotify(){
        $to      = config('payment.notify_email');
        $subject = 'Оплата через сайт';
        $table = "<table><thead>
        <tr>
            <th>
                Тип пакета каналов
            </th>
            <th>
                Цена пакета каналов
            </th>
            <th>
                Количество пакета каналов
            </th>
            <th>
                Итоговый сумма
            </th>
        </tr>
        </thead>";
        foreach ($this->items as $key => $item) {
            $table .= "<tr>
            <td>".$item->tarif->channel->title."</td>
            <td>".$item->item_price." ".$item->currency. "</td>
            <td>".$item->count. "</td>
            <td>".$item->amount_price. "</td>
            </tr>";
        }
        $table .= "</table>";
        $message = '
        <html>
            <head></head>
            <body>
                <p>Произведен оплата за услуга. 
                <br>Номер заказа №'.$this->id.'. Сумма платежа '.$this->amount.' '.$this->currency.'</p><br>
                '.$table.'
                <p> <a href="'.route('admin.payment.index').'">Платежи</a></p>
            </body>
        </html>';

        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf8';

        // Additional headers
        $headers[] = 'To: '.$this->username.' <'.$this->email.'>';
        $headers[] = 'From: Site 911.tv <test@911tv.info>';
        //var_dump($headers);

        $resp = @mail($to, $subject, $message, implode("\r\n", $headers));

    }
}
