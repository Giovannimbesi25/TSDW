<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studente extends Model
{
    protected $fillable = ['nome', 'cognome', 'età','class_id'];
    use HasFactory;

    public function classes(){
        $this->belongsTo(Classe::class);
    }
}
