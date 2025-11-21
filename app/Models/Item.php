<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Database\Factories\ItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $uuid
 * @property int $user_id
 * @property-read string $name
 * @property-read string|null $image
 * @property-read string|null $size
 * @property-read string|null $color
 * @property-read string|null $link
 * @property-read int|null $price
 * @property-read string|null $store
 * @property-read bool $hidden
 * @property-read bool $purchased
 * @property-read int|null $purchased_by
 * @property-read bool $delivered
 * @property-read CarbonImmutable|null $delivered_date
 * @property-read CarbonImmutable $created_at
 * @property-read CarbonImmutable $updated_at
 */
final class Item extends Model
{
    /** @use HasFactory<ItemFactory> */
    use HasFactory;

    public function casts(): array
    {
        return [
            'id' => 'integer',
            'uuid' => 'string',
            'user_id' => 'integer',
            'name' => 'string',
            'image' => 'string',
            'size' => 'string',
            'color' => 'string',
            'link' => 'string',
            'price' => 'integer',
            'store' => 'string',
            'hidden' => 'boolean',
            'purchased' => 'boolean',
            'purchased_by' => 'integer',
            'delivered' => 'boolean',
            'delivered_date' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
