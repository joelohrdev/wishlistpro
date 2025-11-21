<?php

declare(strict_types=1);

use App\Enums\Priority;

test('has correct values', function (Priority $priority, string $expected): void {
    expect($priority->value)->toBe($expected);
})->with([
    [Priority::MUST, 'must'],
    [Priority::HIGH, 'high'],
    [Priority::MEDIUM, 'medium'],
    [Priority::LOW, 'low'],
]);

test('label returns correct human-readable name', function (Priority $priority, string $expected): void {
    expect($priority->label())->toBe($expected);
})->with([
    [Priority::MUST, 'Must Have'],
    [Priority::HIGH, 'High'],
    [Priority::MEDIUM, 'Medium'],
    [Priority::LOW, 'Low'],
]);

test('color returns correct name', function (Priority $priority, string $expected): void {
    expect($priority->color())->toBe($expected);
})->with([
    [Priority::MUST, 'red'],
    [Priority::HIGH, 'orange'],
    [Priority::MEDIUM, 'blue'],
    [Priority::LOW, 'green'],
]);

test('can be created from valid string', function (string $value, Priority $expected): void {
    expect(Priority::from($value))->toBe($expected);
})->with([
    ['must', Priority::MUST],
    ['high', Priority::HIGH],
    ['medium', Priority::MEDIUM],
    ['low', Priority::LOW],
]);
