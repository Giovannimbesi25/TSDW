<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    

    protected $fillable = ['data', 'importo', 'client_id'];

    public function clients(){
        return $this->belongsTo(Client::class);
    }
}
