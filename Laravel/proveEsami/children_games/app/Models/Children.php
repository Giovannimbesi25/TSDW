<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;
    protected $fillable=['nome','cognome','età'];
    public function games(){
        return $this->hasMany(Game::class);
    }
}
