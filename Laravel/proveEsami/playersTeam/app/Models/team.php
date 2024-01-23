<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class team extends Model
{
    protected $fillable=['nome','citta','anno_fondazione'];
    use HasFactory;

    public function players(){
        return $this->hasMany(player::class);
    }
}
