<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmissionItemRequest extends FormRequest
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
            'submission_session_id' => 'integer|exists:submission_sessions,id',
            'division_id' => 'integer|exists:employees,id',
            'regarding' => 'required|string',
            'status' => 'required|string|in:draf,diajukan',
            'code' => 'string|nullable',
            'note' => 'string|nullable',
            'items' => 'required|array',
            'items.*.item_id' => 'required|integer',
            'items.*.qty' => 'required|integer',
        ];
    }
}
