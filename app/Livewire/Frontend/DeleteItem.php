<?php

declare(strict_types=1);

namespace App\Livewire\Frontend;

use App\Models\Item;
use Flux\Flux;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

final class DeleteItem extends Component
{
    #[Locked]
    public Item $item;

    public function deleteItem(): void
    {
        $this->authorize('delete', $this->item);

        if ($this->item->image) {
            Storage::disk('public')->delete($this->item->image);
        }

        $this->item->delete();

        Flux::toast(text: 'Item deleted successfully!', variant: 'success');

        $this->dispatch('item-deleted');
    }

    public function render(): View
    {
        return view('livewire.frontend.delete-item');
    }
}
