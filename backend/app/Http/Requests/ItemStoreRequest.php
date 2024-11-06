<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class ItemStoreRequest extends FormRequest
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
        Log::info($this->all());
        return [
            'code' => 'string|max:255',
            'image' => 'required|file',
            'name' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'unit' => 'required|string|max:255',  // satuan
            'stock' => 'required|integer',
            'min_stock' => 'required|integer',
            'category_id' => 'required|integer',
            'price' => 'required|integer',
        ];
    }
}
