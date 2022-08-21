<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'min:3', 'max:250'],
            'slug'            => [
                'required',
                'string',
                'min:3',
                'max:250',
                Rule::unique('brands')->ignore($this->route('brand_id'))
            ],
            'img'             => ['string', 'max:250'],
            'link'            => ['required', 'string', 'max:250', 'url'],
            'pixel'           => ['nullable', 'string', 'max:250', 'url'],
            'seo_h1'          => ['required', 'string', 'max:250'],
            'seo_title'       => ['required', 'string', 'max:250'],
            'seo_description' => ['required', 'string', 'max:250'],
            'description'     => ['required', 'string'],
            'content'         => ['required', 'string'],
            'country'         => ['required', 'string', 'max:250'],
            'hack_rating'     => ['numeric', 'max:10'],
            'position'        => ['integer'],
            'activity'        => ['required', 'integer', Rule::in(Brand::$status)],
        ];
    }
}