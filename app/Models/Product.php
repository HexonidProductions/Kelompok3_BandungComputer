<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tb_products';

    protected $fillable = [
        'product_code',
        'product_name',
        'category_id',
        'image',
        'description',
        'buy_price',
        'sell_price',
        'stock',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
