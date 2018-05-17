<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const SERVICE_FREEKASSA = 'freekassa';
    const SERVICE_INTERKASSA = 'interkassa';
    
    const STATUS_CANSELED = 'cansel';
    const STATUS_FINISHED = 'finish';

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public static function saveItem($order,$request, $type){
        $payment = new self();
        $payment->service = self::SERVICE_FREEKASSA;
        $payment->amount = $request->input('AMOUNT');
        $payment->currency = config('payment.currency');
        switch ($type) {
            case self::SERVICE_FREEKASSA:
                $payment->transaction_id = $request->input('intid');
                break;
            case self::SERVICE_INTERKASSA:
                $payment->transaction_id = $request->input('ik_pm_no');
                break;
        }
        $payment->details = json_encode($request->input());
        $payment->status = self::STATUS_FINISHED;
        $payment->save();
        Finance::saveItem($payment->amount, $order->user_id, $payment->id, 'Пополнение счета');     
        return $payment->id;
    }
}
