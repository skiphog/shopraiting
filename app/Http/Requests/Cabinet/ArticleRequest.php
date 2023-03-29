<?php

namespace App\Http\Requests\Cabinet;

use App\Models\Article;
use Illuminate\Validation\Rule;
use App\Http\Requests\ArticleRequest as AdminArticleRequest;

class ArticleRequest extends AdminArticleRequest
{
    public function rules(): array
    {
        return [
            'name'           => ['required', 'string', 'min:3', 'max:250'],
            'slug'           => [
                'required',
                'string',
                'min:3',
                'max:250',
                Rule::unique('articles')->ignore($this->route('article'))
            ],
            'img'            => ['string', 'max:250'],
            'intro'          => ['string', 'max:500'],
            'contents'       => ['array'],
            'before_content' => ['string'],
            'content'        => ['required', 'string'],
            'time_to_read'   => ['integer'],
            'activity'       => ['required', 'integer', Rule::in(Article::$status)],
        ];
    }

    /**
     * Добавить custom fields после валидации
     */
    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated($key, $default), [
            'img_alt'         => '',
            'img_title'       => '',
            'seo_h1'          => $this['name'],
            'seo_title'       => $this['name'],
            'seo_description' => $this['name'],
        ]);
    }
}
