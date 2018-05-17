<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "add_bal";

    protected $fillable = ['usid','amount','trx','description','tm'];

    public $timestamps = false;

    public function User()
    {
        return $this->belongsTo('App\Models\Client','usid');
    }

}
