<?php

declare(strict_types=1);

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Model;

beforeEach(function (): void {
    $this->cast = new MoneyCast;
    $this->model = Mockery::mock(Model::class);
});

test('get returns null when value is null', function (): void {
    $result = $this->cast->get($this->model, 'price', null, []);

    expect($result)->toBeNull();
});

test('get returns float divided by 100 when value is numeric', function (): void {
    $result = $this->cast->get($this->model, 'price', 2999, []);

    expect($result)->toBe(29.99);
});

test('get returns null when value is not numeric', function (): void {
    $result = $this->cast->get($this->model, 'price', 'not-a-number', []);

    expect($result)->toBeNull();
});

test('get handles string numeric values', function (): void {
    $result = $this->cast->get($this->model, 'price', '1500', []);

    expect($result)->toBe(15.0);
});

test('set returns null when value is null', function (): void {
    $result = $this->cast->set($this->model, 'price', null, []);

    expect($result)->toBeNull();
});

test('set returns integer multiplied by 100 when value is numeric', function (): void {
    $result = $this->cast->set($this->model, 'price', 29.99, []);

    expect($result)->toBe(2999);
});

test('set returns null when value is not numeric', function (): void {
    $result = $this->cast->set($this->model, 'price', 'not-a-number', []);

    expect($result)->toBeNull();
});

test('set handles string numeric values', function (): void {
    $result = $this->cast->set($this->model, 'price', '15.50', []);

    expect($result)->toBe(1550);
});

test('set rounds to nearest integer', function (): void {
    $result = $this->cast->set($this->model, 'price', 29.999, []);

    expect($result)->toBe(3000);
});
