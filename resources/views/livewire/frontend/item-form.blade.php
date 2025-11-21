<form wire:submit.prevent="save" class="space-y-6 relative">
    <flux:field>
        <flux:input placeholder="What are you wishing for?" wire:model="form.name" />
        <flux:error name="form.name" />
    </flux:field>

    <flux:field>
        <flux:file-upload wire:model="form.image" label="Photo">
            <flux:file-upload.dropzone
                heading="Drop files here or click to browse"
                text="JPG, PNG, GIF up to 10MB"
            />
        </flux:file-upload>
        @if($form->image)
            <div class="mt-4 flex flex-col gap-2">
                <flux:file-item
                    :heading="$form->image->getClientOriginalName()"
                    :image="$form->image->temporaryUrl()"
                    :size="$form->image->getSize()"
                >
                    <x-slot name="actions">
                        <flux:file-item.remove />
                    </x-slot>
                </flux:file-item>
            </div>
        @endif
    </flux:field>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <flux:input placeholder="Color" wire:model="form.color" />
        <flux:input placeholder="Size" wire:model="form.size" />
        <flux:input placeholder="Store Name" wire:model="form.store" />
        <flux:field>
            <flux:input placeholder="Price" wire:model="form.price" />
            <flux:error name="form.price" />
        </flux:field>
        <flux:input placeholder="Link to product..." type="url" class="col-span-2" wire:model="form.link" />
        <flux:radio.group label="Priority" variant="buttons" wire:model="form.priority">
            @foreach(\App\Enums\Priority::cases() as $priority)
                <flux:radio :value="$priority->value" size="xs" value="low" :label="$priority->label()" />
            @endforeach
        </flux:radio.group>
        <flux:select label="Occasion" variant="listbox" placeholder="Choose occasion..." wire:model="form.occasion">
            @foreach(\App\Enums\Occasion::cases() as $occasion)
                <flux:select.option :value="$occasion->value">{{ $occasion->label() }}</flux:select.option>
            @endforeach
        </flux:select>
    </div>

    <div class="flex justify-end gap-3 pt-4 border-t border-stone-100">
        <flux:button variant="ghost" @click="$dispatch('close-form')">Cancel</flux:button>
        <flux:button type="submit" variant="primary" color="rose" class="shadow-lg shadow-rose-200 hover:shadow-rose-300 hover:-translate-y-0.5 hover:cursor-pointer transition-all duration-300">Add to List</flux:button>
    </div>
</form>
