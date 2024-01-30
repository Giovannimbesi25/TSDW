<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $fillable=['nome','prezzo','children_id'];
    public function children(){
        return $this->belongsTo(Children::class);
    }
}
