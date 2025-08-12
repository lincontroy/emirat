<?php

// app/Models/UserLockedPlan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class UserLockedPlan extends Model
{
    protected $guarded = [];

    protected $casts = [
        'amount' => 'decimal:8',
        'expected_yield' => 'decimal:8',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(InvestmentPlan::class);
    }
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }
}