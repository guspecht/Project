<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'title' => 'required',
            'text' => 'required',
            'category' => 'required|integer|exists:categories,id',
            'tags' => 'required'
        ];
    }
}
