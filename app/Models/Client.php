<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	const TYPE_PREMIUM = "2";
	const TYPE_BASIC = "1";
	const TYPE_NOT_SUBSCRIBED = "0";
    
    protected $table = "users";

    protected $fillable = ['email','pkgend'];

    public $timestamps = false;

    public static $rules = [
    	'email' => 'required|email',
    	'pkgend' => 'required',
    ];

    public function getTypeSelect(){
    	$array = [];
    	foreach (self::getTypeInfos() as $key => $item) {
    		$array[$key] = $item['label'];
    	}
    	return $array;
    }

    public function getPkgendAttribute($value){
    	return date("m/d/Y", $value);
    }

    public function setPkgendAttribute($value){
        $this->attributes['pkgend'] = strtotime($value);
    }
}
