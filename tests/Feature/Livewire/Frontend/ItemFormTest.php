<?php

declare(strict_types=1);

use App\Livewire\Frontend\ItemForm;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

test('component can be rendered', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ItemForm::class)
        ->assertStatus(200);
});

test('can save an item with required fields', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ItemForm::class)
        ->set('form.name', 'Test Item')
        ->set('form.priority', 'medium')
        ->set('form.occasion', 'birthday')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('item-created');

    expect(Item::query()->where('name', 'Test Item')->exists())->toBeTrue();
    expect($user->items()->count())->toBe(1);
});

test('can save an item with all fields', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ItemForm::class)
        ->set('form.name', 'Complete Item')
        ->set('form.size', 'Large')
        ->set('form.color', 'Blue')
        ->set('form.link', 'https://example.com/item')
        ->set('form.price', '99.99')
        ->set('form.store', 'Test Store')
        ->set('form.priority', 'high')
        ->set('form.occasion', 'birthday')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('item-created');

    $item = Item::query()->where('name', 'Complete Item')->first();
    expect($item)->not->toBeNull();
    expect($item->size)->toBe('Large');
    expect($item->color)->toBe('Blue');
    expect($item->link)->toBe('https://example.com/item');
    expect($item->store)->toBe('Test Store');
});

test('can save an item with an image', function (): void {
    Storage::fake('public');
    $user = User::factory()->create();

    $image = UploadedFile::fake()->image('item.jpg');

    Livewire::actingAs($user)
        ->test(ItemForm::class)
        ->set('form.name', 'Item with Image')
        ->set('form.priority', 'high')
        ->set('form.occasion', 'christmas')
        ->set('form.image', $image)
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('item-created');

    $item = Item::query()->where('name', 'Item with Image')->first();
    expect($item)->not->toBeNull();
    expect($item->image)->not->toBeNull();
    Storage::disk('public')->assertExists($item->image);
});

test('validates required name field', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ItemForm::class)
        ->set('form.name', '')
        ->call('save')
        ->assertHasErrors(['form.name' => 'required']);
});

test('validates name minimum length', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ItemForm::class)
        ->set('form.name', 'A')
        ->call('save')
        ->assertHasErrors(['form.name' => 'min']);
});

test('validates name maximum length', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ItemForm::class)
        ->set('form.name', str_repeat('a', 256))
        ->call('save')
        ->assertHasErrors(['form.name' => 'max']);
});

test('validates link is a valid url', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ItemForm::class)
        ->set('form.name', 'Test Item')
        ->set('form.priority', 'medium')
        ->set('form.occasion', 'birthday')
        ->set('form.link', 'not-a-url')
        ->call('save')
        ->assertHasErrors(['form.link' => 'url']);
});

test('form is reset after saving', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ItemForm::class)
        ->set('form.name', 'Test Item')
        ->set('form.color', 'Red')
        ->set('form.priority', 'high')
        ->set('form.occasion', 'anniversary')
        ->call('save')
        ->assertSet('form.name', '')
        ->assertSet('form.color', '');
});

test('item is associated with authenticated user', function (): void {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ItemForm::class)
        ->set('form.name', 'User Item')
        ->set('form.priority', 'must')
        ->set('form.occasion', 'birthday')
        ->call('save');

    $item = Item::query()->where('name', 'User Item')->first();
    expect($item->user_id)->toBe($user->id);
});
