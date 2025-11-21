<div>
    <div class="flex items-center justify-between mb-6"><h2 class="font-serif text-2xl text-stone-800">Your Collection</h2></div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($this->items as $item)
            <div class="h-full">
                <div class="group relative bg-white rounded-3xl p-3 transition-all duration-500 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] flex flex-col h-full border border-stone-100">
                    <div class="aspect-[4/3] w-full overflow-hidden rounded-2xl relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10 "></div>
                        <img alt="Noise Cancelling Headphones" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-out " src="{{ $item->image ?: asset('placeholder.png') }}">
                        <div class="absolute top-3 left-3 z-20 flex flex-col gap-2">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-md text-stone-800 text-xs font-bold rounded-full shadow-sm uppercase tracking-wider">{{ $item->occasion->label() }}</span>
                        </div>
                        <div class="absolute top-3 right-3 z-20"></div>
                        <div class="absolute bottom-3 right-3 z-20 translate-y-10 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 flex gap-2">
                            <a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer" class="p-2 bg-white text-stone-900 rounded-full shadow-lg hover:bg-rose-50 hover:text-rose-600 transition-colors" title="View Product">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link w-4 h-4" aria-hidden="true"><path d="M15 3h6v6"></path><path d="M10 14 21 3"></path><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path></svg>
                            </a>
                            <livewire:frontend.delete-item :$item />
                        </div>
                    </div>
                    <div class="pt-4 px-2 pb-2 flex-1 flex flex-col">
                        <div class="flex justify-between items-start gap-4 mb-2">
                            <h3 class="font-serif text-xl font-bold leading-tight group-hover:text-rose-600 transition-colors text-stone-900">{{ $item->name }}</h3>
                            <span class="shrink-0 font-serif font-semibold text-lg text-stone-900">${{ $item->price }}</span>
                        </div>
                        <div class="flex flex-wrap gap-3 mb-4">
                            @if($item->store)
                            <flux:badge size="sm">{{ $item->store }}</flux:badge>
                            @endif
                            @if($item->color)
                            <flux:badge size="sm">{{ $item->color }}</flux:badge>
                            @endif
                            @if($item->size)
                            <flux:badge size="sm">{{ $item->size }}</flux:badge>
                            @endif
                        </div>
                        <div class="mt-auto flex items-center gap-2 pt-2">
                            <flux:badge size="sm" :color="$item->priority->color()">{{ $item->priority->label() }}</flux:badge>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>
