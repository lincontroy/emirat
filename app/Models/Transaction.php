<?php

// app/Models/Transaction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Transaction extends Model
{
    protected $fillable = [
        'amount', 'status', 'meta', 'user_id', 
        'transactionable_id', 'transactionable_type'
    ];

    protected $casts = [
        'amount' => 'decimal:8',
        'meta' => 'array'
    ];

    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
