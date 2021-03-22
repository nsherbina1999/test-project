<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'item_id' => 'required|integer',
            'client_name' => 'required|string|max:255',
            'client_address' => 'required|string|max:255',
            'shipment_id' => 'required|integer',
            'credit_card_number' => 'required|integer|digits:16',
            'credit_card_cvv' => 'required|integer|digits:3',
            'credit_card_expire' => 'required|integer|digits:4',
        ];
    }
}
