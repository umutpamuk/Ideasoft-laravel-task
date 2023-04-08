<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Resources\Order\OrderDetailsResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends BaseController
{

    /**
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        $orders = Order::with('items')->get();

        if (COUNT($orders) > 0) {
            foreach ($orders as $order) {
                $response[] = new OrderDetailsResource($order);
            }

            return $this->JsonResponse($response);

        } else {
            return $this->JsonResponse(null, 404);
        }


    }

    /**
     * @param OrderCreateRequest $request
     * @return JsonResponse
     */
    public function store(OrderCreateRequest $request) : JsonResponse
    {
        // Stok Kontrol
        foreach ($request->cart as $cart) {
            Product::productQuantityCheck($cart);
        }

        // Sipariş Oluştur
        $total = 0;
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->total = $total;
        $order->save();

        foreach ($request->cart as $item) {
            $product = Product::find($item['product_id']);
            $total += $item['quantity'] * $product->price;

            $product->stock -= $item['quantity'];
            $product->save();

            $orderItem = new OrderItem();
            $orderItem->order_id    = $order->id;
            $orderItem->product_id  = $item['product_id'];
            $orderItem->quantity    = $item['quantity'];
            $orderItem->unit_price  = $product->price;
            $orderItem->total       = $item['quantity'] * $product->price;
            $orderItem->save();
        }

        $order = Order::find($order->id);
        $order->total = $total;
        $order->save();

        $customer = Customer::find($request->customer_id);
        $customer->revenue += $total;
        $customer->save();

        return $this->JsonResponse(new OrderDetailsResource($order));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy(int $id) : JsonResponse
    {
       $order = Order::find($id);

       if ($order) {

           $order->delete();

           return $this->JsonResponse(['success' => true]);

       } else {

           return $this->JsonResponse(null, 404);

       }

    }
}
