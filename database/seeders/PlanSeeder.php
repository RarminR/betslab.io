<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::updateOrCreate(
            ['slug' => 'monthly'],
            [
                'name' => 'Monthly Pro',
                'price' => 49.00,
                'duration_days' => 30,
                'is_lifetime' => false,
                'is_active' => true,
            ]
        );

        Plan::updateOrCreate(
            ['slug' => 'lifetime'],
            [
                'name' => 'Lifetime Access',
                'price' => 299.00,
                'duration_days' => null,
                'is_lifetime' => true,
                'is_active' => true,
            ]
        );
    }
}

