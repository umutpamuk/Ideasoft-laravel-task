<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exceptions\HttpResponseException;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function productQuantityCheck($cart)
    {
        $product = Product::find($cart['product_id']);

        if (!$product || $product->stock < $cart['quantity']) {
            throw new HttpResponseException(response()->json(['error' => 'Insufficient Stock'], 400));
        }
    }
}
