<?php

namespace App\Repositories\Order;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function all() : AnonymousResourceCollection
    {
        $orders = Order::with('items')->get();

        return OrderResource::collection($orders);
    }

    /**
     * @param OrderStoreRequest $request
     * @return OrderResource
     * @throws \Exception
     */
    public function store(OrderStoreRequest $request) : OrderResource
    {
        $cart = $request->input('cart');
        $data = $request->validated();

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            if (!$product->isStockAvailable() || $product->stock < $item['quantity']) {
                throw new \Exception('Ürünün stoğu yetersiz.');
            }
        }

        // Sipariş Oluştur
        $total = 0;
        try {
            DB::beginTransaction();

            $order = Order::create([
                'customer_id' => $data['customer_id'],
                'total' => $total,
            ]);

            foreach ($cart as $item) {
                $product = Product::find($item['product_id']);
                $product->decrement('stock', $item['quantity']);

                $total += $item['quantity'] * $product->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'total' => $item['quantity'] * $product->price,
                ]);
            }

            $order->update(['total' => $total]);

            $order->customer->revenue += $total;
            $order->customer->save();

            DB::commit();

            return new OrderResource($order);
        } catch (\Throwable $throwable) {
            DB::rollBack();
            throw new \Exception($throwable->getMessage());
        }
    }

    /**
     * @param int $id
     * @return OrderResource
     */
    public function destroy(int $id): OrderResource
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return new OrderResource($order);
    }

}
