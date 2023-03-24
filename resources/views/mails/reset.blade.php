@extends('layouts.mail')

@section('title', 'Сброс пароля')
@section('description', 'Сброс пароля')

@section('content')
<tr>
    <td style="text-align:center;padding: 30px 30px 15px 30px;">
        <h2 style="font-size: 18px; color: #6576ff; font-weight: 600; margin: 0;">Сброс пароля</h2>
    </td>
</tr>
<tr>
    <td style="text-align:center;padding: 0 30px 20px">
        <p style="margin-bottom: 10px;">{{ __('Привет,') }} {{ $user->name }}!</p>
        <p style="margin-bottom: 10px;">Вы изменили личные данные для входа на сайт {{ config('app.name') }}. Перейдите по</p>
        <p style="margin-bottom: 10px;text-align:center;">
            <a href="{{ $url }}" style="background-color:#6576ff;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0 25px">Ссылке</a>
        </p>
        <p style="margin-bottom: 10px;">чтобы сбросить пароль.</p>
        <p style="margin-bottom: 10px;">Обратите внимание! Если вы не изменяли личные данные на сайте, не используйте вышеуказанную ссылку и обратитесь в техподдержку прямо сейчас. Чтобы связаться с нами, воспользуйтесь формой обратной связи.</p>
        <p style="margin-bottom: 25px;">С уважением, Администрация {{ config('app.name') }}.</p>
    </td>
</tr>
@endsection
