<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{   
    protected $fillable = ['title', 'description'];
    use HasFactory;

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
