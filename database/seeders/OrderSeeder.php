<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderJsonFile = Storage::get('data/orders.json');
        $orders = json_decode($orderJsonFile);
        foreach ($orders as $order) {

            $orderId = Order::insertGetId([
                'customer_id' => $order->customerId,
                'total' => $order->total,
                'created_at' => Carbon::now(),
            ]);

            foreach ($order->items as $orderItem) {
                OrderItem::create([
                    'order_id' => $orderId,
                    'product_id' => $orderItem->productId,
                    'quantity' => $orderItem->quantity,
                    'unit_price' => $orderItem->unitPrice,
                    'total' => $orderItem->total,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
    }
}
