<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max: 100|min: 5',
            'content' => 'required|min: 5',
            'image' => 'mimes:jpeg,jpg,png|max: 10000',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}
