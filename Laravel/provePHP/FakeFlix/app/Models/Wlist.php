<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wlist extends Model
{
    protected $fillable = ['titolo', 'regista'];
    use HasFactory;
}
