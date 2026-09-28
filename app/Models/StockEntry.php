<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockEntry extends Model
{
    use HasFactory;

    protected $table = 'tb_stock_entries';

    protected $fillable = [
        'entry_code',
        'supplier_name',
        'phone_number',
        'email',
        'address',
        'status',
    ];
}
