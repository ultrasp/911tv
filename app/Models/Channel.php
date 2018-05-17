<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['title','img','content'];

    public $timestamps = false;

    public static $folder = 'images/channel/';

    public function tarifs()
    {
        return $this->hasMany(Tarif::class);
    }

    public function orderItems()
    {
        return $this->hasMany(orderItem::class);
    }

    public static $rules = [
    	'title' => 'required|string',
    	'img' => 'image',
        'content' => 'required'
    ];


    public function getImageUrl(){
    	return asset(self::$folder.$this->img);
    }

    public static function getList(){
        return self::all()->pluck('title','id');
    }
}
