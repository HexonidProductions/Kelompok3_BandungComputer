<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'tb_sales';

    protected $fillable = [
        'receipt_number',
        'sale_type',
        'cashier_id',
        'customer_id',
        'shipping_address',
        'payment_method',
        'total_amount',
        'shipping_fee',
        'payment_status',
    ];
}
