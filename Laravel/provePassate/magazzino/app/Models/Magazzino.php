<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazzino extends Model
{
    protected $fillable = ['nome_prodotto', 'giacenza', 'prezzo'];
    //By default laravel pluralizes the model names to be be the table names unless stated otherwise in the model by.
    use HasFactory;
}
