<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Authorization logic can be added here
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'productname' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'quantity' => 'required|numeric',
            'weight' => 'required|numeric',
            'size' => 'required|numeric',
            'is_available' => 'required|boolean',
        ];

        if ($this->isMethod('post')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else {
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'productname.required' => 'The product name is required.',
            'productname.string' => 'The product name must be a string.',
            'productname.max' => 'The product name must not exceed 255 characters.',
            'price.required' => 'The product price is required.',
            'price.numeric' => 'The product price must be a number.',
            'description.required' => 'The product description is required.',
            'description.string' => 'The product description must be a string.',
            'quantity.required' => 'The product quantity is required.',
            'quantity.numeric' => 'The product quantity must be a number.',
            'weight.required' => 'The product weight is required.',
            'weight.numeric' => 'The product weight must be a number.',
            'size.required' => 'The product size is required.',
            'size.numeric' => 'The product size must be a number.',
            'is_available.required' => 'The availability status is required.',
            'is_available.boolean' => 'The availability status must be true or false.',
            'image.required' => 'The product image is required for new products.',
            'image.image' => 'The product image must be an image file.',
            'image.mimes' => 'The product image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The product image must not exceed 2048 kilobytes.',
        ];
    }
}
