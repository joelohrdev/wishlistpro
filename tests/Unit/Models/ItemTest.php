<?php

declare(strict_types=1);

use App\Models\Item;
use App\Models\User;

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

test('user', function (): void {
    $user = User::factory()->create();

    $item = $user->items()->create(['name' => 'Item 1']);

    expect($item->user->id)->toBe($user->id);
});
