<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Finance extends Model
{
    const TYPE_ADDING = 'adding';
    const TYPE_MINUSING = 'minusing';
    protected $table = "user_finance";

    public static function saveItem($amount, $user_id, $object_id, $detail,  $is_filling =  true){
        $action = new self();
        $action->type = ($is_filling) ? self::TYPE_ADDING : self::TYPE_MINUSING;
        $action->user_id = $user_id;
        $action->amount = $amount;
        $action->currency = config('payment.currency');
        $action->details = $detail;
        $action->object_id =$object_id;
        $action->save();
    }

    public function getSign(){
        return ($this->type == self::TYPE_ADDING) ? '+' : '-';
    }
}
