<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{   
    protected $fillable=['materia','anno','scuola'];
    use HasFactory;
    public function studentes(){
        return $this->hasMany(Studente::class);
    }
}
