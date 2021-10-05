<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $fillable = [
        'roomname',
        'status',
        'price',
        'detail',
        'images'
    ];

    public function rent(){
        return $this->belongsTo(Rent::class);
    }
}
