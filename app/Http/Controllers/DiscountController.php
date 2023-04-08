<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * @param $orderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyDiscount($orderId)
    {
        $order = Order::where('id', $orderId)->first();

        if (empty($order)) {
            return response()->json(['status'=>'error', 'message' => 'Order Id Not Found'], 404);
        }

        $totalDiscount   = 0;
        $discountedTotal = $order->total;
        $subtotal        = $discountedTotal;

        $response['orderId'] = $order->id;

        if ($order->total >= 1000) {
            $discountAmount = number_format($order->total - (0.90 * $order->total), 2, '.', '');
            $subtotal       = number_format($subtotal - $discountAmount, 2, '.', '');

            $totalDiscount   += $discountAmount;
            $discountedTotal = $subtotal;

            $response['discounts'][] = [
                'discountReason' => "10_PERCENT_OVER_1000",
                'discountAmount' => $discountAmount,
                'subtotal'       => $subtotal,
            ];
        }

        $orderItems = OrderItem::where('order_id', $order->id)->get();
        $categoryArray = [];
        foreach ($orderItems as $orderItem) {
            $product = Product::findOrFail($orderItem->product_id);

            $categoryCount = 0;
            if (isset($categoryArray[$product->category_id]['count'])) {
                $categoryCount = $categoryArray[$product->category_id]['count'];
            }

            $categoryArray[$product->category_id]['count'] = $categoryCount + $orderItem->quantity;
            $categoryArray[$product->category_id]['productDetails'][] = [
                'product_id'  => $product->id,
                'category_id' => $product->category_id,
                'price'       => $product->price
            ];
        }

        if (isset($categoryArray[2]['count']) && $categoryArray[2]['count'] >= 6) {

            $minPrice  = min(array_column($categoryArray[2]['productDetails'], 'price'));
            $freeItems = floor($categoryArray[2]['count'] / 6);

            $discountAmount = number_format($freeItems * $minPrice, 2, '.', '');
            $subtotal       = number_format($subtotal - $discountAmount, 2, '.', '');

            $totalDiscount   += $discountAmount;
            $discountedTotal = $subtotal;

            $response['discounts'][] = [
                'discountReason' => "BUY_5_GET_1_FOR_CATEGORY_2",
                'discountAmount' => $discountAmount,
                'subtotal'       => $subtotal,
            ];
        }

        if (isset($categoryArray[1]['count']) && $categoryArray[1]['count'] >= 2) {

            $minPrice  = min(array_column($categoryArray[1]['productDetails'], 'price'));

            $discountAmount = number_format(0.80 * $minPrice, 2, '.', '');
            $subtotal       = number_format($subtotal - $discountAmount, 2, '.', '');

            $totalDiscount   += $discountAmount;
            $discountedTotal = $subtotal;

            $response['discounts'][] = [
                'discountReason' => "20_PERCENT_OVER_2_FOR_CATEGORY_1",
                'discountAmount' => $discountAmount,
                'subtotal'       => $subtotal,
            ];
        }

        $response['totalDiscount']   = number_format($totalDiscount, 2, '.', '');
        $response['discountedTotal'] = $discountedTotal;

        return response()->json($response);
    }
}
