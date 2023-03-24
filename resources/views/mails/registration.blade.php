@extends('layouts.mail')

@section('title', 'Подтверждение email')
@section('description', 'Подтверждение email')

@section('content')
<tr>
    <td style="padding: 30px 30px 15px 30px;">
        <h2 style="font-size: 18px; color: #6576ff; font-weight: 600; margin: 0;">Подтвердите Ваш электронный адрес</h2>
    </td>
</tr>
<tr>
    <td style="padding: 0 30px 20px">
        <p style="margin-bottom: 10px;">Здравствуйте.</p>
        <p style="margin-bottom: 10px;">Для завершения регистрации, перейдите, пожалуйста, по</p>
        <p style="margin-bottom: 10px;text-align:center;">
            <a href="{{ $url }}" style="background-color:#6576ff;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform:uppercase;padding:0 30px">ссылке</a>
        </p>
        <p style="margin-bottom: 10px;">Чтобы связаться с нами, воспользуйтесь формой обратной связи.</p>
        <p style="margin-bottom: 25px;">С уважением, Администрация {{ config('app.name') }}.</p>
    </td>
</tr>
<tr>
    <td style="padding: 0 30px">
        <h4 style="font-size:15px;color:#000000;font-weight:600;text-transform:uppercase;margin: 0 0 10px;">или</h4>
        <p style="margin-bottom:10px;">Если кнопка выше не работает, вставьте эту ссылку в свой браузер:</p>
        <a href="{{ $url }}" style="color:#6576ff;text-decoration:none;word-break:break-all;">{{ $url }}</a>
    </td>
</tr>
@endsection