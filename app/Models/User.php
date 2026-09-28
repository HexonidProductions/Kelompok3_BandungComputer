<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tb_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone_number',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function cashierSales()
    {
        return $this->hasMany(Sale::class, 'cashier_id');
    }

    public function customerSales()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }

    public function isAdmin(): bool
    {
        return strtolower($this->role) === 'admin';
    }

    public function isCashier(): bool
    {
        return strtolower($this->role) === 'cashier';
    }

    public function isCustomer(): bool
    {
        return strtolower($this->role) === 'customer';
    }
}