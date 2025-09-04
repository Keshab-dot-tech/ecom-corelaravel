<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'shipping_address',
        'invoice_address',
        'price',
        'payment_method',
    ];

    protected $casts = [
        'shipping_address' => 'array',
        'invoice_address'  => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
