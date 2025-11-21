<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class ItemPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Item $item): bool
    {
        return $item->user_id === $user->id;
    }
}
