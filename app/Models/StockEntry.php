<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockEntry extends Model
{
    protected $table = 'tb_stock_entries';

    protected $fillable = [
        'entry_code',
        'supplier_name',
        'phone_number',
        'address',
        'status',
    ];
}
