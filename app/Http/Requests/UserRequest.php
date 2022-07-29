<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @noinspection PhpArrayShapeAttributeCanBeAddedInspection
     */
    public function rules(): array
    {
        return [
            'email'       => [
                'required',
                'email',
                'max:250',
                Rule::unique('users')->ignore($this->route('user'))
            ],
            'name'        => ['required', 'string', 'max:250'],
            'description' => ['nullable', 'string'],
            'role'        => ['required', 'integer', Rule::in(array_keys(User::$roles))],
        ];
    }
}