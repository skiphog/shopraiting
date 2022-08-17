<?php

namespace App\Http\Requests;

use App\Models\Shop;
use Illuminate\Foundation\Http\FormRequest;

class ReviewShopRequest extends FormRequest
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
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'post_type' => Shop::class
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
            'post_id'      => ['required', 'integer', 'exists:shops,id'],
            'post_type'    => ['required', 'string'],
            'rating'       => ['required', 'numeric', 'min:1', 'max:10'],
            'author_name'  => ['required', 'string', 'max:250'],
            'author_email' => ['required', 'string', 'max:250', 'email'],
            'content'      => ['required', 'string', 'min:3']
        ];
    }
}
