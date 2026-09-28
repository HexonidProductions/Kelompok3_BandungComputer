<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyClosing extends Model
{
    use HasFactory;

    protected $table = 'tb_daily_closings';

    protected $fillable = [
        'cashier_id',
        'physical_cash',
        'system_cash',
        'discrepancy',
        'notes',
    ];

    protected $casts = [
        'physical_cash' => 'decimal:2',
        'system_cash' => 'decimal:2',
        'discrepancy' => 'decimal:2',
    ];

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }
}
