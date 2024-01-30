<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costume extends Model
{
    use HasFactory;

    protected $fillable=['name', 'prezzo', 'job', 'img', 'region_id'];
    public function regions(){
        return $this->belongsTo(Region::class);
    }
}
