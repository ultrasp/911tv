<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    protected $table = "admin";

	protected $fillable = [
	    'username','password',
	];

	protected $hidden = [
	    'password',
	];
}
