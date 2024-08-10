<?php

namespace App\Http\Requests\Branch;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('branches')->where(function ($query) {
                    return $query
                        ->where('id', '!=', $this->branch->id)
                        ->where('section_id', $this->input('section_id'))
                        ->where('parent_id', $this->input('parent_id'));
                }),
            ],
            'section_id' => ['required', 'integer', 'exists:sections,id'],
            'parent_id' => ['nullable'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => __('validation.required'),
            '*.unique' => __('validation.unique'),

        ];
    }
}
