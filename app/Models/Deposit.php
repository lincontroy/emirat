<?php

// app/Models/Deposit.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Deposit extends Model
{
    protected $fillable = [
        'user_id',
        'wallet_address',
        'amount',
        'currency',
        'tx_hash',
        'status',
        'source',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
        'amount' => 'decimal:8'
    ];

    public function transaction(): MorphOne
    {
        return $this->morphOne(Transaction::class, 'transactionable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
