<?php

declare(strict_types=1);

use App\Enums\Occasion;

test('has correct values', function (Occasion $occasion, string $expected): void {
    expect($occasion->value)->toBe($expected);
})->with([
    [Occasion::BIRTHDAY, 'birthday'],
    [Occasion::CHRISTMAS, 'christmas'],
    [Occasion::ANNIVERSARY, 'anniversary'],
    [Occasion::OTHER, 'other'],
]);

test('label returns correct human-readable name', function (Occasion $occasion, string $expected): void {
    expect($occasion->label())->toBe($expected);
})->with([
    [Occasion::BIRTHDAY, 'Birthday'],
    [Occasion::CHRISTMAS, 'Christmas'],
    [Occasion::ANNIVERSARY, 'Anniversary'],
    [Occasion::OTHER, 'Other'],
]);

test('can be created from valid string', function (string $value, Occasion $expected): void {
    expect(Occasion::from($value))->toBe($expected);
})->with([
    ['birthday', Occasion::BIRTHDAY],
    ['christmas', Occasion::CHRISTMAS],
    ['anniversary', Occasion::ANNIVERSARY],
    ['other', Occasion::OTHER],
]);

test('tryFrom returns null for invalid value', function (): void {
    expect(Occasion::tryFrom('invalid'))->toBeNull();
});
