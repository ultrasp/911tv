<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{

    protected $table = "step_post";

    public $timestamps = false;

    protected $fillable = ['content','platform_id'];
    
    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
