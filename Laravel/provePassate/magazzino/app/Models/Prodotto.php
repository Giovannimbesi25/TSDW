<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodotto extends Model
{
    protected $fillable = ['nome_prodotto', 'giacenza', 'prezzo'];
    use HasFactory;
}
