<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'products','user_id', 
        'status', 'id', 'sum'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
