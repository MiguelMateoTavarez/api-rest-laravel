<?php

namespace App\Http\Requests\API\V1\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'author_id' => 'required|exists:authors,id',
            'gender_id' => 'required|exists:genders,id',
            'title' => 'required|',
            'isbn' => 'required|string|max:13|unique:book,isbn',
            'pages' => 'required|integer|min:1',
            'stock' => 'required|integer|min:1',
            'published_at' => 'required|date',
        ];
    }
}
