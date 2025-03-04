<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'name'  =>  'required|string|max:255',
            'remarks'   =>  'nullable|string|max:255',
            'type_id'  =>  'required|numeric|exists:types,id',
        ];
    }
}
