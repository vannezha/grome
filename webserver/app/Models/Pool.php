<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use HasFactory;

    public function grometool(){
        return $this->belongsTo(Grometool::class,'guid','guid');
    }
}
