<?php

 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id',
        'product_id',
        'quantity', // <-- MAKE SURE THIS IS HERE!
        'price',
        'session_id', // Add any other fields you have
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

 