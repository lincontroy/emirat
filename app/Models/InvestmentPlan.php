<?php

// app/Models/InvestmentPlan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
    protected $guarded = [];

    protected $casts = [
        'min_amount' => 'decimal:8',
        'yield_percentage' => 'decimal:2',
        'penalty_percentage' => 'decimal:2',
        'apy' => 'decimal:2',
        'is_active' => 'boolean'
    ];
}
