<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['nomeProdotto','prezzo','giacenza','order_id'];

    public function orders(){
        return $this->belongsTo(Order::class);
    }
}
