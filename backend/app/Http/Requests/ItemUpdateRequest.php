<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
{
    public $image;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'file|image',
            'code' => 'string|max:255',
            'name' => 'string|max:255',
            'merk' => 'string|max:255',
            'type' => 'string|max:255',
            'size' => 'string|max:255',
            'unit' => 'string|max:255',  // satuan
            'stock' => 'integer',
            'min_stock' => 'integer',
            'category_id' => 'integer',
            'price' => 'integer',
        ];
    }
}
