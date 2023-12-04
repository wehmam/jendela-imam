<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CarsRequest extends FormRequest
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
        $id = $this->route('car'); // Assuming 'car' is the route parameter name
        
        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('cars', 'name')->ignore($id),
            ],
            'price' => [
                'required',
                'numeric',
                'min:0'
            ],
            'stock' => [
                'required',
                'numeric',
                'min:0',
            ]
        ];
    }
}
