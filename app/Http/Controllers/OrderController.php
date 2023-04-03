<?php

namespace App\Http\Controllers;

use App\Http\Resources\Order\OrderDetailsResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {
        //
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
