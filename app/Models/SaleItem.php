<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $table = 'tb_sale_items';

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
    ];
}
