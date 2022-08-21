<?php

namespace App\Http\Requests;

use App\Models\Shop;
use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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

    /**
     * @return string[]
     */
    protected function allowedTypes(): array
    {
        return [
            'shops'  => Shop::class,
            'brands' => Brand::class
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'product_type' => $this->allowedTypes()[$this['type']] ?? Shop::class
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @noinspection PhpArrayShapeAttributeCanBeAddedInspection
     */
    public function rules(): array
    {
        return [
            'product_id'   => [
                'required',
                'integer',
                'exists:' . (array_key_exists($this['type'], $this->allowedTypes()) ? $this['type'] : 'shops') . ',id'
            ],
            'product_type' => ['required', 'string'],
            'rating'       => ['required', 'numeric', 'min:1', 'max:10'],
            'author_name'  => ['required', 'string', 'max:250'],
            'author_email' => ['required', 'string', 'max:250', 'email'],
            'content'      => ['required', 'string', 'min:3']
        ];
    }
}
