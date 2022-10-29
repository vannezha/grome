<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grometool extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'guid',
        'setpoint',
    ];
    protected $casts = [
        'guid' => 'string',
    ];

    public function user(){
        return $this->belongsTo(User::class,'username','username');
    }

    public function pool(){
        return $this->hasMany(Pool::class, 'guid', 'guid');
    }
}
