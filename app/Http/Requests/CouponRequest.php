<?php

namespace App\Http\Requests;

use App\Models\Coupon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'coupons.*.color'          => ['required', 'string', Rule::in(Coupon::COLORS)],
            'coupons.*.type'           => ['required', 'string', Rule::in(Coupon::TYPES)],
            'coupons.*.type_content'   => ['required', 'string', 'max:250'],
            'coupons.*.title'          => ['required', 'string', 'min:3', 'max:250'],
            'coupons.*.content'        => ['required', 'string'],
            'coupons.*.button_type'    => ['required', 'string', Rule::in(Coupon::BUTTON_TYPES)],
            'coupons.*.button_content' => ['required', 'string', 'max:250'],
            'coupons.*.start_at'       => ['required', 'string', 'date'],
            'coupons.*.end_at'         => ['required', 'string', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'coupons.*.title.required' => 'Введите заголовок'
        ];
    }
}
