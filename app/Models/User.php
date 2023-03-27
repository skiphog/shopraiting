<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property int            $id
 * @property string         $email
 * @property string         $slug
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
     * Static roles
     */
    public const ROLES = [
        'USER'      => 1,
        'AUTHOR'    => 2,
        'MODERATOR' => 3,
        'ADMIN'     => 4
    ];

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'slug',
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
     * Типы ролей
     *
     * @return string[]
     */
    public static function rolesList(): array
    {
        return [
            static::ROLES['USER']      => 'Пользователь',
            static::ROLES['AUTHOR']    => 'Автор',
            static::ROLES['MODERATOR'] => 'Модератор',
            static::ROLES['ADMIN']     => 'Администратор',
        ];
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role > static::ROLES['MODERATOR'];
    }

    /**
     * @return bool
     */
    public function isModerator(): bool
    {
        return $this->role > static::ROLES['AUTHOR'];
    }

    /**
     * @return bool
     */
    public function isAuthor(): bool
    {
        return $this->role > static::ROLES['USER'];
    }

    /**
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'user_id', 'id');
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopeAuthors(Builder $query): Builder
    {
        return $query->where('role', static::ROLES['AUTHOR']);
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
            get: fn() => static::rolesList()[$this->role] ?? null,
        );
    }
}
