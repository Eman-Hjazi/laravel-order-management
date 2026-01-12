<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            ['name'=>'Product A','price'=>50,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Product B','price'=>20,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Product C','price'=>100,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
