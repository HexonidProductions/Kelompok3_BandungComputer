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

    protected $casts = [
        'total_amount' => 'decimal:2',
        'shipping_fee' => 'decimal:2',
    ];

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class, 'sale_id');
    }
}
