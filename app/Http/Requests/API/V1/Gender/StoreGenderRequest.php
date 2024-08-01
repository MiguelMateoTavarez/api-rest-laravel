<?php

namespace App\Http\Requests\API\V1\Gender;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:genders,name'
        ];
    }
}
