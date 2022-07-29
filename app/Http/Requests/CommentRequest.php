<?php

namespace App\Http\Requests;

use App\Models\Comment;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
     * @return array
     * @noinspection PhpArrayShapeAttributeCanBeAddedInspection
     */
    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'max:250'],
            'email'        => ['required', 'string', 'max:250', 'email'],
            'avatar_color' => ['required', 'string', Rule::in(array_keys(Comment::$avatars))],
            'message'      => ['required', 'string'],
        ];
    }
}
