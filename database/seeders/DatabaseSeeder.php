<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Occasion;
use App\Enums\Priority;
use App\Enums\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Joe Lohr',
            'email' => 'emailme@joelohr.com',
            'role' => Role::PARENT,
            'password' => bcrypt('password'),
        ]);

        $user->items()->create([
            'name' => 'Noise Cancelling Headphones',
            'image' => 'https://picsum.photos/id/1/400/300',
            'color' => 'Black',
            'link' => 'https://www.amazon.com/dp/B071111111',
            'price' => 249.95,
            'store' => 'Amazon',
            'priority' => Priority::HIGH,
            'occasion' => Occasion::CHRISTMAS,
        ]);
    }
}
