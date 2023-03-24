<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\User
 *
 * @property int            $id
 * @property string         $email
 * @property string         $password
 * @property string         $name
 * @property string         $avatar
 * @property string|null    $description
 * @property int            $status
 * @property int            $role
 * @property string         $role_name
 * @property string|null    $remember_token
 * @property Carbon|null    $email_verified_at
 * @property Carbon|null    $created_at
 * @property Carbon|null    $updated_at
 *
 * @property-read Article[] $articles
 * @property-read int|null  $articles_count
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'avatar',
        'description',
        'status',
        'role',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string[]
     */
    public static array $status = [
        0 => 'Не активный',
        1 => 'Активный',
    ];

    /**
     * @var string[]
     */
    public static array $roles = [
        1 => 'Пользователь',
        2 => 'Автор',
        3 => 'Модератор',
        4 => 'Администратор'
    ];

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role > 3;
    }

    /**
     * @return bool
     */
    public function isModerator(): bool
    {
        return $this->role > 2;
    }

    /**
     * @return bool
     */
    public function isAuthor(): bool
    {
        return $this->role > 1;
    }

    /**
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'user_id', 'id');
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->id === 2 ? route('authors.marina-medvedeva') : route('authors.show', $this);
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: static fn($value) => $value ?: '/images/users/no-avatar.png',
        );
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function roleName(): Attribute
    {
        return Attribute::make(
            get: fn() => static::$roles[$this->role] ?? null,
        );
    }
}
