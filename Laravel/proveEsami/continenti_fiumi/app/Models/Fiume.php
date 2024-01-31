<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiume extends Model
{
    use HasFactory;

    protected $fillable=['nome', 'lunghezza', 'foce','continent_id'];
    public function regions(){
        return $this->belongsTo(Continent::class);
    }
}
