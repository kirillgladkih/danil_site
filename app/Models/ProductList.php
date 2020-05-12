<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    public $timestapms = false;

    protected $fillable = [
        'name', 'price', 'img_path', 'id'
    ];
}
