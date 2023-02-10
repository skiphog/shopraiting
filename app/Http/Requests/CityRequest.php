<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (null === $this['shops']) {
            $this['shops'] = [];
        }
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'max:250'],
            'slug'            => [
                'required',
                'string',
                'min:3',
                'max:250',
                Rule::unique('cities')->ignore($this->route('city'))
            ],
            'seo_h1'          => ['required', 'string', 'max:250'],
            'seo_title'       => ['required', 'string', 'max:250'],
            'seo_description' => ['required', 'string', 'max:250'],
            'before_content'  => ['nullable', 'string'],
            'content'         => ['required', 'string'],
            'postcode'        => ['nullable', 'string', 'max:13'],
            'shops'           => ['array']
        ];
    }
}