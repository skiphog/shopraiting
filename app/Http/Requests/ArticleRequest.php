<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (is_string($this['content'])) {
            $this['content'] = _content($this['content']);
            $this['contents'] = _contents($this['content']);
            $this['time_to_read'] = _timeToRead($this['content']);
        }

        if (null === $this['intro']) {
            $this['intro'] = '';
        }

        if (null === $this['before_content']) {
            $this['before_content'] = '';
        }
    }

    public function rules(): array
    {
        return [
            'user_id'         => ['required', 'integer', 'exists:users,id'],
            'name'            => ['required', 'string', 'min:3', 'max:250'],
            'slug'            => [
                'required',
                'string',
                'min:3',
                'max:250',
                Rule::unique('articles')->ignore($this->route('article_id'))
            ],
            'img'             => ['string', 'max:250'],
            'img_alt'         => ['string', 'max:250'],
            'img_title'       => ['string', 'max:250'],
            'intro'           => ['string', 'max:500'],
            'contents'        => ['array'],
            'before_content'  => ['string'],
            'content'         => ['required', 'string'],
            'seo_h1'          => ['required', 'string', 'max:250'],
            'seo_title'       => ['required', 'string', 'max:250'],
            'seo_description' => ['required', 'string', 'max:250'],
            'time_to_read'    => ['integer'],
            'activity'        => ['required', 'integer', Rule::in(Article::$status)],
        ];
    }
}