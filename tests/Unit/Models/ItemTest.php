<?php

declare(strict_types=1);

use App\Models\Item;

test('to array', function (): void {
    $item = Item::factory()->create()->refresh();

    expect(array_keys($item->toArray()))
        ->toBe([
            'id',
            'uuid',
            'user_id',
            'name',
            'image',
            'size',
            'color',
            'link',
            'price',
            'store',
            'hidden',
            'purchased',
            'purchased_by',
            'delivered',
            'created_at',
            'updated_at',
        ]);
});
