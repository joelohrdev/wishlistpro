<?php

declare(strict_types=1);

use App\Enums\Role;

test('has expected cases', function (): void {
    expect(Role::cases())->toHaveCount(3);
});

test('has correct values', function (Role $role, string $expected): void {
    expect($role->value)->toBe($expected);
})->with([
    [Role::PARENT, 'parent'],
    [Role::RELATIVE, 'relative'],
    [Role::CHILD, 'child'],
]);

test('label returns correct human-readable name', function (Role $role, string $expected): void {
    expect($role->label())->toBe($expected);
})->with([
    [Role::PARENT, 'Parent'],
    [Role::RELATIVE, 'Relative'],
    [Role::CHILD, 'Child'],
]);

test('can be created from valid string', function (string $value, Role $expected): void {
    expect(Role::from($value))->toBe($expected);
})->with([
    ['parent', Role::PARENT],
    ['relative', Role::RELATIVE],
    ['child', Role::CHILD],
]);

test('tryFrom returns null for invalid value', function (): void {
    expect(Role::tryFrom('invalid'))->toBeNull();
});
