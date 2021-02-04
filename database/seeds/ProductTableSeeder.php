<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        Product::create([
            'name' => "cookie",
            'type_id' => 3,
            'price' => 12.00,
        ]);

        Product::create([
            'name' => "ice cream",
            'type_id' => 2,
            'price' => 15.00,
        ]);
        
        Product::create([
            'name' => "cake",
            'type_id' => 1,
            'price' => 25.00,
        ]);
    }
}
