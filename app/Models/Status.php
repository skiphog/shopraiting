<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait Status
{
    /**
     * Возможный статус модели
     *
     * @var array
     */
    public static array $status = [
        'inactive' => 0,
        'active'   => 1
    ];

    /**
     * @noinspection PhpUnused
     */
    protected static function bootStatus(): void
    {
        static::addGlobalScope('activity', static function (Builder $builder) {
            $builder->where('activity', static::$status['active']);
        });
    }

    /**
     * Статусы моделей
     *
     * @return string[]
     */
    public static function statusList(): array
    {
        return [
            static::$status['inactive'] => 'Неактивный',
            static::$status['active']   => 'Активный'
        ];
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function statusText(): Attribute
    {
        return Attribute::make(get: static fn(
            $value,
            $attributes
        ) => static::statusList()[$attributes['activity']] ?? '');
    }
}
