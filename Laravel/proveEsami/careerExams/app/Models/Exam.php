<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable=['corso','data','voto','career_id'];
    public function career(){
        return $this->belongsTo(Career::class);
    }
}
