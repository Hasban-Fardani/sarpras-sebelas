<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestItemRequest extends FormRequest
{
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
            'code' => 'nullable|string',
            'items' => 'required|array',
            'status' => 'required|string|in:draf,diajukan',
            'division_id' => 'integer|exists:employees,id',
            'regarding' => 'required|string',
            'characteristic' => 'required|string',
            'items.*.item_id' => 'required|integer',
            'items.*.qty' => 'required|integer',
        ];
    }
}
