<?php

use App\Stock;
use Illuminate\Database\Seeder;

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stock::truncate();

        Stock::create([
            'product_id' => 1,
            'quantity' => 1000,
        ]);

        Stock::create([
            'product_id' => 2,
            'quantity' => 2000,
        ]);

        Stock::create([
            'product_id' => 3,
            'quantity' => 3000,
        ]);
    }
}
