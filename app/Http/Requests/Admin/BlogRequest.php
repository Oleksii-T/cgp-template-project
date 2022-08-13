<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $model = $this->route('blog');

        return [
            'thumbnail' => [$model ? 'nullable' : 'required', 'image', 'max:10000'],
            'images' => ['nullable', 'array'],
            'images.*' => [$model ? 'nullable' : 'required', 'image', 'max:10000'],
            'title' => ['required', 'array'],
            'title.en' => ['required', 'string', 'max:255'],
            'title.*' => ['nullable', 'string', 'max:255'],
            'slug' => ['required', 'array'],
            'slug.en' => ['required', 'string', 'max:50'],
            'slug.*' => ['nullable', 'string', 'max:50'],
            'content' => ['required', 'array'],
            'content.en' => ['required', 'string', 'max:10000'],
            'content.*' => ['nullable', 'string', 'max:10000'],
        ];
    }
}
