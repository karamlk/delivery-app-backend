<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'store_id'];

    public function store()
    {
        return $this->belongsTo(Store::class); 
    }
}

