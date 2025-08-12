<?php

// database/seeders/InvestmentPlansTableSeeder.php

use App\Models\InvestmentPlan;
use Illuminate\Database\Seeder;

class InvestmentPlansTableSeeder extends Seeder
{
    public function run()
    {
        $plans = [
            [
                'name' => '7-day Lock',
                'slug' => '7-day',
                'min_amount' => 100.00,
                'yield_percentage' => 0.9,
                'penalty_percentage' => 0.3,
                'apy' => 5.0,
                'duration_days' => 7,
                'is_active' => true,
            ],
            [
                'name' => '30-day Lock',
                'slug' => '30-day',
                'min_amount' => 250.00,
                'yield_percentage' => 2.6,
                'penalty_percentage' => 0.8,
                'apy' => 6.5,
                'duration_days' => 30,
                'is_active' => true,
            ],
            [
                'name' => '6-month Lock',
                'slug' => '6-month',
                'min_amount' => 500.00,
                'yield_percentage' => 4.1,
                'penalty_percentage' => 1.5,
                'apy' => 8.1,
                'duration_days' => 180, // 6 months
                'is_active' => true,
            ]
        ];

        foreach ($plans as $plan) {
            InvestmentPlan::updateOrCreate(
                ['slug' => $plan['slug']],
                $plan
            );
        }
    }
}
