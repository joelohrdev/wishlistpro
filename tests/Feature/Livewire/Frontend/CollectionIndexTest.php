<?php

declare(strict_types=1);

use App\Livewire\Frontend\CollectionIndex;
use App\Models\Item;
use App\Models\User;
use Livewire\Livewire;

test('component can be rendered', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CollectionIndex::class)
        ->assertStatus(200);
});

test('component displays user items', function (): void {
    $user = User::factory()->create();
    $item = Item::factory()->for($user)->create([
        'name' => 'Test Wishlist Item',
    ]);

    Livewire::actingAs($user)
        ->test(CollectionIndex::class)
        ->assertSee('Test Wishlist Item')
        ->assertSee($item->occasion->label())
        ->assertSee($item->priority->label());
});

test('component only displays items belonging to authenticated user', function (): void {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $userItem = Item::factory()->for($user)->create([
        'name' => 'My Item',
    ]);
    $otherUserItem = Item::factory()->for($otherUser)->create([
        'name' => 'Other User Item',
    ]);

    Livewire::actingAs($user)
        ->test(CollectionIndex::class)
        ->assertSee('My Item')
        ->assertDontSee('Other User Item');
});

test('component displays multiple items', function (): void {
    $user = User::factory()->create();

    $items = Item::factory()->for($user)->count(3)->create();

    $component = Livewire::actingAs($user)
        ->test(CollectionIndex::class);

    foreach ($items as $item) {
        $component->assertSee($item->name);
    }
});

test('component displays item price', function (): void {
    $user = User::factory()->create();

    Item::factory()->for($user)->create([
        'name' => 'Priced Item',
        'price' => 29.99,
    ]);

    Livewire::actingAs($user)
        ->test(CollectionIndex::class)
        ->assertSee('Priced Item')
        ->assertSee('$29.99');
});

test('component displays item store when present', function (): void {
    $user = User::factory()->create();

    Item::factory()->for($user)->create([
        'store' => 'Test Store',
    ]);

    Livewire::actingAs($user)
        ->test(CollectionIndex::class)
        ->assertSee('Test Store');
});

test('component displays item color when present', function (): void {
    $user = User::factory()->create();

    Item::factory()->for($user)->create([
        'color' => 'blue',
    ]);

    Livewire::actingAs($user)
        ->test(CollectionIndex::class)
        ->assertSee('blue');
});

test('component displays item size when present', function (): void {
    $user = User::factory()->create();

    Item::factory()->for($user)->create([
        'size' => 'Large',
    ]);

    Livewire::actingAs($user)
        ->test(CollectionIndex::class)
        ->assertSee('Large');
});

test('component handles empty collection', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(CollectionIndex::class)
        ->assertStatus(200)
        ->assertSee('Your Collection');
});

test('items computed property returns user items', function (): void {
    $user = User::factory()->create();
    $items = Item::factory()->for($user)->count(2)->create();

    $component = Livewire::actingAs($user)
        ->test(CollectionIndex::class);

    expect($component->get('items'))->toHaveCount(2);
});
