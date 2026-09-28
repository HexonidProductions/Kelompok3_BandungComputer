<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyClosing extends Model
{
    protected $table = 'tb_daily_closings';

    protected $fillable = [
        'cashier_id',
        'physical_cash',
        'system_cash',
        'discrepancy',
        'notes',
    ];
}
