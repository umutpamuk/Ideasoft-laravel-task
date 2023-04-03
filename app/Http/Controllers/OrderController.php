<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Resources\Order\OrderDetailsResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('items')->get();

        if (COUNT($orders) > 0) {
            foreach ($orders as $order) {
                $response[] = new OrderDetailsResource($order);
            }

            return response()->json($response);

        } else {

            return response()->json(['status' => 'error', 'message' => 'Not Fount'], 404);

        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderCreateRequest $request)
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

        return response()->json(new OrderDetailsResource($order));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $order = Order::find($id);

       if ($order) {

           $order->delete();

           return response()->json(['success' => true],200);
       } else {

           return response()->json(['status' => 'error', 'message' => 'Not Fount'], 404);
       }

    }
}
