<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency',
        'wallet_address',
        'network',
        'is_active',
        'instructions'
    ];
}