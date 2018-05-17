<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['item_id','item_price','currency','amount_price','count'];
    
    public function order(){
        return $this->belongsTo(Order::class);
    }

	public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'item_id');
    }

}
