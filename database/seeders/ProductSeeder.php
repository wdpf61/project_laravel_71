<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("products")->insert([
            "name"=>"Laptop",
            "price"=>50000,
            "qty"=>1,
            "photo"=> "laptop.jpg",
            "description"=> "Good",
            "status"=> 1,
        ]);
    }
}
