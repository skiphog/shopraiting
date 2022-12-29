<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
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

        $this['slug'] = Str::slug($this['name']);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:250'],
            'slug'     => [
                'required',
                'string',
                'min:3',
                'max:250',
                Rule::unique('cities')->ignore($this->route('city'))
            ],
            'postcode' => ['string', 'max:13'],
            'shops'    => ['array']
        ];
    }
}