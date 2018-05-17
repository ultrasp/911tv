<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarif extends Model
{
    use SoftDeletes;
    protected $fillable = ['channel_id','price', 'period', 'api_id'];

    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public static $rules = [
        'channel_id' => 'required|integer',
    	'price' => 'required|numeric',
    	'period' => 'required|integer',
    	'api_id' => 'integer|nullable'
    ];

}
