<?php
/**
 * Created by Skiphog
 * 30-6-2022 18:24
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (!empty($this['message']) && is_string($this['message'])) {
            $seo = str($this['message'])->limit(250)->toString();
            $this->merge([
                'seo_h1'          => $seo,
                'seo_title'       => $seo,
                'seo_description' => $seo
            ]);
        }
    }

    /**
     * @noinspection PhpArrayShapeAttributeCanBeAddedInspection
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'max:250'],
            'email'           => ['required', 'string', 'max:250', 'email'],
            'message'         => ['required', 'string'],
            'seo_h1'          => ['string', 'max:250'],
            'seo_title'       => ['string', 'max:250'],
            'seo_description' => ['string', 'max:250'],
        ];
    }
}