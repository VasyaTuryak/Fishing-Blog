<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|min:15',
            'body'=>'required|max:1000',
            'photo.*' => 'file|image|max:5048|mimes:jpeg,jpg,png',
        ];
    }

    public function messages():array
    {
        return [
            'title.required' => 'The name field is required.',
            'title.min' => 'The title must be at least 15 characters long.',
            'body.required' => 'The description field is required.',
            'body.max' => 'The description max characters must be not more 1000 characters long.',
        ];
    }
}
