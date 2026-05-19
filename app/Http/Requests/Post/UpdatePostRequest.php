<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'title'     => ['sometimes', 'string', 'min:5', 'max:255'],
            'body'      => ['sometimes', 'string', 'min:20'],
            'published' => ['sometimes', 'boolean'],
        ];
    }
}
