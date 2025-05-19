<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3',
            'price' => 'nullable|numeric',
            'selling_price' => 'nullable|numeric',
            'qty' => 'nullable|numeric',
            'brand' => 'required|integer',
            'category' => 'required|integer',
            'featuredImage' => 'nullable|mimes:png,jpg,webp,jpeg',
            'galleryImages.*' => 'nullable|mimes:png,jpg,webp,jpeg',
        ];
    }


    function messages()
    {
        return [
            'featuredImage.mimes' => 'Please select a extension of png.'
        ];
    }
}
