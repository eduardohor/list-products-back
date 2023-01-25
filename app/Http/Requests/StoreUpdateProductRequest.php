<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'unique:products'],
            'price' => ['required'],
            'image' => ['required', 'image'],
            'description' => ['required', 'string', 'min:10', 'max:256'],

        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules = [
                'name' => ['nullable', 'unique:products'],
                'price' => ['nullable'],
                'image' => ['nullable', 'image'],
                'description' => ['nullable', 'string', 'min:10', 'max:256'],
            ];
        }
        return $rules;
    }
}
