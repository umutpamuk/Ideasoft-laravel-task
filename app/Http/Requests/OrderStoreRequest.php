<?php

namespace App\Http\Requests;

use App\Rules\CheckProductStock;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'customer_id'        => 'required|exists:customers,id',
            'cart.*.product_id'  => 'required|exists:products,id',
            'cart.*.quantity'    => [
                'required',
                'integer',
                'min:1',
                'max:50',
            ],
        ];
    }
}
