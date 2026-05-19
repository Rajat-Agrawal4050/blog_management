<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // return Auth::check();
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'min:2', 'max:2000'],
        ];
    }
}
