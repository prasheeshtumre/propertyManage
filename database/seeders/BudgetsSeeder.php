<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Budget;

class BudgetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $budgets = [
            ['amount' => 5, 'unit' => 5],
            ['amount' => 10, 'unit' => 5],
            ['amount' => 15, 'unit' => 5],
            ['amount' => 20, 'unit' => 5],
            ['amount' => 25, 'unit' => 5],
            ['amount' => 30, 'unit' => 5],
            ['amount' => 40, 'unit' => 5],
            ['amount' => 50, 'unit' => 5],
            ['amount' => 60, 'unit' => 5],
            ['amount' => 75, 'unit' => 5],
            ['amount' => 90, 'unit' => 5],
            ['amount' => 1, 'unit' => 6],
            ['amount' => 1.25, 'unit' => 6],
            ['amount' => 1.5, 'unit' => 6],
            ['amount' => 1.75, 'unit' => 6],
            ['amount' => 2, 'unit' => 6],
            ['amount' => 3, 'unit' => 6],
            ['amount' => 4, 'unit' => 6],
            ['amount' => 5, 'unit' => 6],
            ['amount' => 10, 'unit' => 6],
            ['amount' => 20, 'unit' => 6],
            ['amount' => 30, 'unit' => 6],
            ['amount' => 50, 'unit' => 6],
            ['amount' => 60, 'unit' => 6],
            ['amount' => 70, 'unit' => 6],
        ];

        foreach ($budgets as $budget) {
            Budget::create($budget);
        }
    }
}
