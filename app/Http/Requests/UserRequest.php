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

    protected function prepareForValidation(): void
    {
        $this['slug'] = str($this['slug'] ?? '')->slug()->toString();
    }

    /**
     * @noinspection PhpArrayShapeAttributeCanBeAddedInspection
     */
    public function rules(): array
    {
        $rules_role = ['required', 'integer', Rule::in(User::ROLES)];

        if (1 === (int)$this->route('user')?->id) {
            $rules_role[] = 'min:4';
        }

        return [
            'email'       => [
                'required',
                'email',
                'max:250',
                Rule::unique('users')->ignore($this->route('user'))
            ],
            'slug'        => ['required', 'string', 'max:250', Rule::unique('users')->ignore($this->route('user'))],
            'name'        => ['required', 'string', 'max:250'],
            'description' => ['nullable', 'string'],
            'role'        => $rules_role,
        ];
    }

    /**
     * @noinspection PhpArrayShapeAttributeCanBeAddedInspection
     */
    public function messages(): array
    {
        return ['role.min' => 'Супер пользователь не может иметь права ниже администратора'];
    }
}