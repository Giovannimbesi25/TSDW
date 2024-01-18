<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class player extends Model
{   
    protected $fillable=['nome', 'cognome', 'età', 'team_id'];
    use HasFactory;

    public function teams(){
        return $this->belongsTo(team::class);
    }
}
