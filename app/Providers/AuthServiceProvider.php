<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        VerifyEmail::toMailUsing(static function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Подтверждение регистрации')
                ->view('mails.registration', compact('url'));
        });

        ResetPassword::toMailUsing(static function ($notifiable, $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $email = $notifiable->getEmailForPasswordReset(),
            ], false));

            $user = User::where('email', $email)->firstOrFail();

            return (new MailMessage)
                ->subject('Сброс пароля')
                ->view('mails.reset', compact('url', 'user'));
        });
    }
}
