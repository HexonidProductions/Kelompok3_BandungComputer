<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyClosing extends Model
{

    protected $table = 'tb_daily_closings';

    protected $fillable = [
        'admin_id',
        'total_income',
        'notes',
    ];

    protected $casts = [
        'total_income' => 'decimal:2',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function getShiftAttribute() 
    {
        $hour = $this->updated_at->format('H');
        if ($hour >= 6 && $hour < 14) {
            return 'Morning Shift';
        } elseif ($hour >= 14 && $hour < 22) {
            return 'Night Shift';
        }

    }
}
