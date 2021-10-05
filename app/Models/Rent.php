<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'cusname',
        'telephone',
        'cusemail',
        'rentdate',
    ];
    public function room(){
        return $this->hasOne(Room::class);
    }
    // public static function boot(){
    //     parent
    // }
}
