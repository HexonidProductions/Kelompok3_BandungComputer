<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    protected $table = 'tb_inventory_logs';

    protected $fillable = [
        'product_id',
        'supplier_id',
        'type',
        'customer_name',
        'quantity',
        'notes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function supplier()
    {
        return $this->belongsTo(StockEntry::class, 'supplier_id');
    }
}
