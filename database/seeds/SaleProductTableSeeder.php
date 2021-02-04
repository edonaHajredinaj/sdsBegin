<?php

use App\SaleProduct;
use Illuminate\Database\Seeder;

class SaleProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SaleProduct::truncate();

        SaleProduct::create([
            'product_id' => 1,
            'quantity' => 5,
        ]);
        
        SaleProduct::create([
            'product_id' => 2,
            'quantity' => 50,
        ]);
    }
}
