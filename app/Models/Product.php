<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = ['name', 'price', 'category_id', 'brand_id'];


    public function category()
    {
        // return $this->belongsTo(Category::class);
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        // return $this->belongsTo(Brand::class);
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function sizes()
    {
        // return $this->belongsToMany(Size::class);
        return $this->belongsToMany(Size::class, 'product_size','size_id','product_id')
                    ->withTimestamps();
    }

    public function cart()
{
    return $this->hasMany(Cart::class);
}

}
