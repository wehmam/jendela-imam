<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdersRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "customer_name" => "required",
            "phone" => [
                "required",
                "numeric",
                "min:0"
            ],
            "email" => "required",
            "cars" => "required|exists:cars,id"
        ];
    }
}
