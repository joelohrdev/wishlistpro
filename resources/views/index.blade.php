<x-layouts.frontend>
    @if(auth()->user())
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-stone-200/60 pb-8">
            <div>
                <span class="text-stone-500 text-sm font-medium mb-2 block uppercase tracking-wider">Welcome back</span>
                <h1 class="font-serif text-4xl md:text-5xl text-stone-900 leading-tight">
                    Hello, <span class="italic text-stone-600">{{ auth()->user()?->firstName() ?? 'Guest' }}</span>.
                </h1>
                <p class="mt-4 text-stone-500 max-w-lg leading-relaxed">
                    Curate your perfect moments. You have <strong class="text-stone-900">{{ auth()->user()?->itemCount() }} items</strong> on your list.
                </p>
            </div>
        </div>
    @else
        <h1>Log in</h1>
    @endif
</x-layouts.frontend>
