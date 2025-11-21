<?php

declare(strict_types=1);

namespace App\Livewire\Frontend;

use App\Livewire\Forms\ItemForm as ItemFormObject;
use App\Models\User;
use Flux\Flux;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

final class ItemForm extends Component
{
    use WithFileUploads;

    public ItemFormObject $form;

    public function save(): void
    {
        $this->validate();

        /** @var array<string, mixed> $data */
        $data = $this->form->all();

        if ($this->form->image instanceof TemporaryUploadedFile) {
            $data['image'] = $this->form->image->store('items', 'public');
        }

        /** @var User $user */
        $user = auth()->user();
        $user->items()->create($data);

        $this->form->reset();

        $this->dispatch('item-created');

        Flux::toast(text: 'Item created successfully!', variant: 'success');
    }

    public function render(): Factory|View
    {
        return view('livewire.frontend.item-form');
    }
}
