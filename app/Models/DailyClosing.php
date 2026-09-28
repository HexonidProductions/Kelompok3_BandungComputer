<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyClosing extends Model
{

    protected $table = 'tb_daily_closings';

    protected $fillable = [
        'cashier_id',
        'total_income',
        'notes',
    ];

    protected $casts = [
        'total_income' => 'decimal:2',
    ];

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }
}
