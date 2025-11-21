<?php

declare(strict_types=1);

use App\Livewire\Frontend\DeleteItem;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

test('component can be rendered', function (): void {
    $user = User::factory()->create();
    $item = Item::factory()->for($user)->create();

    Livewire::actingAs($user)
        ->test(DeleteItem::class, ['item' => $item])
        ->assertStatus(200);
});

test('can delete an item without an image', function (): void {
    $user = User::factory()->create();
    $item = Item::factory()->for($user)->create(['image' => null]);

    Livewire::actingAs($user)
        ->test(DeleteItem::class, ['item' => $item])
        ->call('deleteItem')
        ->assertDispatched('item-deleted');

    expect(Item::query()->find($item->id))->toBeNull();
});

test('can delete an item with an image', function (): void {
    Storage::fake('public');
    $user = User::factory()->create();

    $imagePath = 'items/test-image.jpg';
    Storage::disk('public')->put($imagePath, 'fake image content');

    $item = Item::factory()->for($user)->create(['image' => $imagePath]);

    Storage::disk('public')->assertExists($imagePath);

    Livewire::actingAs($user)
        ->test(DeleteItem::class, ['item' => $item])
        ->call('deleteItem')
        ->assertDispatched('item-deleted');

    expect(Item::query()->find($item->id))->toBeNull();
    Storage::disk('public')->assertMissing($imagePath);
});

test('dispatches item-deleted event after deletion', function (): void {
    $user = User::factory()->create();
    $item = Item::factory()->for($user)->create();

    Livewire::actingAs($user)
        ->test(DeleteItem::class, ['item' => $item])
        ->call('deleteItem')
        ->assertDispatched('item-deleted');
});
