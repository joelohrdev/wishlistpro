<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Occasion;
use App\Enums\Priority;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
final class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->sentence(3),
            'size' => fake()->optional()->randomElement(['XS', 'S', 'M', 'L', 'XL', 'One Size']),
            'color' => fake()->optional()->safeColorName(),
            'link' => fake()->optional()->url(),
            'price' => fake()->optional()->numberBetween(1000, 50000),
            'store' => fake()->optional()->company(),
            'priority' => fake()->randomElement(Priority::cases()),
            'occasion' => fake()->randomElement(Occasion::cases()),
            'purchased' => null,
            'purchased_by' => null,
            'delivered' => null,
            'hidden' => false,
        ];
    }

    /**
     * Indicate the item has been purchased.
     */
    public function purchased(): static
    {
        return $this->state(fn (array $attributes): array => [
            'purchased' => fake()->dateTimeBetween('-30 days', 'now'),
            'purchased_by' => fake()->numberBetween(1, 100),
        ]);
    }

    /**
     * Indicate the item has been purchased and delivered.
     */
    public function delivered(): static
    {
        return $this->state(function (array $attributes): array {
            $purchasedDate = fake()->dateTimeBetween('-30 days', '-3 days');

            return [
                'purchased' => $purchasedDate,
                'purchased_by' => fake()->numberBetween(1, 100),
                'delivered' => fake()->dateTimeBetween($purchasedDate, 'now'),
            ];
        });
    }
}
