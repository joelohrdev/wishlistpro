<?php

declare(strict_types=1);

namespace App\Livewire\Frontend;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

final class CollectionIndex extends Component
{
    /**
     * @return Collection<int, Item>
     */
    #[Computed]
    #[On('item-created')]
    #[On('item-deleted')]
    public function items(): Collection
    {
        /** @var User $user */
        $user = auth()->user();

        return $user->items()->get();
    }

    public function render(): View
    {
        return view('livewire.frontend.collection-index');
    }
}
