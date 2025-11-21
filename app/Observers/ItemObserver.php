<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Item;
use Illuminate\Support\Str;

final class ItemObserver
{
    public function creating(Item $item): void
    {
        $item->uuid = (string) Str::uuid();
    }
}
