<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (null === $this['before_content']) {
            $this['before_content'] = '';
        }

        if (null === $this['shops']) {
            $this['shops'] = [];
        }
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return array_merge([
            'user_id'         => ['required', 'integer', 'exists:users,id'],
            'name'            => ['required', 'string', 'max:250'],
            'seo_h1'          => ['required', 'string', 'max:250'],
            'seo_title'       => ['required', 'string', 'max:250'],
            'seo_description' => ['required', 'string', 'max:250'],
            'before_content'  => ['string'],
            'content'         => ['required', 'string'],
            'shops'           => ['array']
        ],
            $this->resolveSlug()
        );
    }

    protected function resolveSlug(): array
    {
        $rules = [];

        if (1 !== (int)$this->route('page')?->id) {
            $rules['slug'] = [
                'required',
                'string',
                'min:3',
                'max:250',
                Rule::unique('pages')->ignore($this->route('page'))
            ];
        }

        return $rules;
    }
}