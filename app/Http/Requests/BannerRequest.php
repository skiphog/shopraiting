<?php

namespace App\Http\Requests;

use App\Models\Banner;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:250'],
            'path'     => ['required', 'string'],
            'link'     => ['required', 'string', 'url'],
            'activity' => ['required', 'integer', Rule::in(Banner::$status)],
        ];
    }
}