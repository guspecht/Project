<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'tags' => 'required',
            'image' => 'nullable|image|dimensions:max_width=200,max_height=400'
        ];
    }
}
