<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubDescriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'description'   =>  'required|array',
            'description.*' => 'required|string|max:1000',
        ];
    }
}
