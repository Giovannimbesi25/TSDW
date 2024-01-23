<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable=['titolo', 'genere','pubblicazione', 'author_id'];

    public function authors(){
        return $this->belongsTo(Author::class);
    }
}
