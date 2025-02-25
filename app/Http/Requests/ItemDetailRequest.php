<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'title'     => 'required|string|max:255',
            'details'   =>  'nullable|string|max:1500',
        ];
    }
}
