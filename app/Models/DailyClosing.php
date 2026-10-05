<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function getShiftAttribute() 
    {
        // Gunakan created_at/updated_at, jika null gunakan waktu saat ini (now())
        $date = $this->created_at ?? $this->updated_at ?? now();
        $hour = (int) Carbon::parse($date)->format('H');

        // Jam 06:00 - 13:59
        if ($hour >= 6 && $hour < 14) {
            return 'Morning Shift';
        }
        return 'Night Shift';
    }
}