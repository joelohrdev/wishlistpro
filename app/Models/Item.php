<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\ItemObserver;
use Carbon\CarbonImmutable;
use Database\Factories\ItemFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @property-read CarbonImmutable|null $purchased
 * @property-read int|null $purchased_by
 * @property-read CarbonImmutable|null $delivered
 * @property-read CarbonImmutable $created_at
 * @property-read CarbonImmutable $updated_at
 */
#[ObservedBy(ItemObserver::class)]
final class Item extends Model
{
    /** @use HasFactory<ItemFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
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
            'purchased' => 'datetime',
            'purchased_by' => 'integer',
            'delivered' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
