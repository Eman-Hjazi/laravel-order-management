<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء بعض الطلبات تجريبية
        Order::create([
            'user_id'=>1,
            'product_id'=>1,
            'quantity'=>2,
            'price'=>50,
            'discount'=>0,
            'total'=>100,
        ]);

        Order::create([
            'user_id'=>2,
            'product_id'=>2,
            'quantity'=>6,
            'price'=>20,
            'discount'=>2, // 10% من 20
            'total'=>108,
        ]);
    }
}
