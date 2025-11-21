<?php

declare(strict_types=1);

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

/**
 * @implements CastsAttributes<float|null, float|int|string|null>
 */
final class MoneyCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?float
    {
        if ($value === null) {
            return null;
        }

        if (is_numeric($value)) {
            return (float) $value / 100;
        }

        return null;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?int
    {
        if ($value === null) {
            return null;
        }

        if (is_numeric($value)) {
            return (int) round((float) $value * 100);
        }

        return null;
    }
}
