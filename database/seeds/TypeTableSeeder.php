<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::truncate();

        Type::create([
            'type' => "Vanilla",
        ]);
        
        Type::create([
            'type' => "Mint Chocolate",
        ]);

        Type::create([
            'type' => "malicious cherry",
        ]);
    }
}
