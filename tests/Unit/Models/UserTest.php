<?php

declare(strict_types=1);

use App\Models\User;

test('to array', function (): void {
    $user = User::factory()->create()->refresh();

    expect(array_keys($user->toArray()))
        ->toBe([
            'id',
            'name',
            'email',
            'email_verified_at',
            'role',
            'created_at',
            'updated_at',
            'two_factor_confirmed_at',
        ]);
});

it('returns the initials', function (): void {
    $user = User::factory()->create(['name' => 'John Doe']);

    expect($user->initials())->toBe('JD');
});

it('returns the first name', function (): void {
    $user = User::factory()->create(['name' => 'John Doe']);

    expect($user->firstName())->toBe('John');
});

it('returns item count', function (): void {
    $user = User::factory()->create();
    expect($user->itemCount())->toBe(0);

    $user->items()->create(['name' => 'Item 1']);
    expect($user->itemCount())->toBe(1);
});
