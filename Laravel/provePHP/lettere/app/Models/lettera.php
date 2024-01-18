<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lettera extends Model
{
    protected $fillable = ['nome', 'quantità', 'consegnata'];

    use HasFactory;
}
