<?php

namespace App\Http\Requests;

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
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     * @noinspection PhpArrayShapeAttributeCanBeAddedInspection
     */
    public function rules(): array
    {
        return [
            'shop_id'      => ['required', 'integer', 'exists:shops,id'],
            'rating'       => ['required', 'numeric', 'min:1', 'max:10'],
            'author_name'  => ['required', 'string', 'max:250'],
            'author_email' => ['required', 'string', 'max:250', 'email'],
            'content'      => ['required', 'string', 'min:3']
        ];
    }
}
