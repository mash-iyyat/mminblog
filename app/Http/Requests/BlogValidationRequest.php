<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogValidationRequest extends FormRequest
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
          'title' => 'required|max:50|unique:blogs,title',
          'content' => 'required',
          'image' => 'nullable',
          'image.*' => 'image|mimes:png,jpeg,jpg|max:2048',
        ];
    }

    public function messages()
    {
      return [
        'title.required' => "Blog title is required.",
        'title.max' => "Maximum 50 characters for blog title.",
        'title.unique' => 'Blog title already used',
        'content.required' => 'Blog content is required',
        'content.max' => 'Maximum 200 characters for blog content',
        'image.mimes' => 'Invalid image file type'
      ];
    }
}
