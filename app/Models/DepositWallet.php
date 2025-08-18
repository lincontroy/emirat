<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositWallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_address',
        'network',
        'is_active'
    ];
    public function scopeActive($query)
{
    return $query->where('is_active', true);
}
}