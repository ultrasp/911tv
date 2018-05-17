<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','content'];

    public static $rules = [
    	'title' => 'required|string',
    	'content' => 'required'
    ];

}
