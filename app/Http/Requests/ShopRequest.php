<?php

namespace App\Http\Requests;

use App\Models\Shop;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this['content'])) {
            $this['content'] = _content($this['content']);
            $this['contents'] = _contents($this['content']);
        }

        if (null === $this['advantage']) {
            $this['advantage'] = '';
        }

        if (null === $this['description']) {
            $this['description'] = '';
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:250'],
            'slug' => [
                'required',
                'string',
                'min:3',
                'max:250',
                Rule::unique('shops')->ignore($this->route('shop_id'))
            ],

            'img'                     => ['string', 'max:250'],
            'link'                    => ['required', 'string', 'max:250'],
            'pixel'                   => ['required', 'string', 'max:250', 'url'],
            'seo_h1'                  => ['required', 'string', 'max:250'],
            'seo_title'               => ['required', 'string', 'max:250'],
            'seo_description'         => ['required', 'string', 'max:250'],
            'seo_h1_reviews'          => ['required', 'string', 'max:250'],
            'seo_title_reviews'       => ['required', 'string', 'max:250'],
            'seo_description_reviews' => ['required', 'string', 'max:250'],
            'advantage'               => ['string', 'max:250'],
            'description'             => ['string', 'max:500'],
            'contents'                => ['array'],
            'content'                 => ['required', 'string'],
            'hack_rating'             => ['numeric', 'max:10'],
            'position'                => ['integer'],
            'cities_cnt'              => ['nullable', 'integer', 'min:1'],
            'brands_cnt'              => ['nullable', 'integer', 'min:1'],
            'products_cnt'            => ['nullable', 'integer', 'min:1'],
            'delivery_cost'           => ['nullable', 'string', 'max:250'],
            'delivery_time'           => ['nullable', 'string', 'max:250'],
            'discounts'               => ['nullable', 'string', 'max:250'],
            'founding_year'           => ['nullable', 'string', 'date_format:Y'],
            'activity'                => ['required', 'integer', Rule::in(Shop::$status)],
        ];
    }
}
