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

        <div class="space-y-8">
            <div x-data="{ show: false }" x-modelable="show" @close-form.window="show = false">
                <button @click="show = ! show" x-show="!show" class="w-full bg-white rounded-3xl border border-stone-200 p-8 flex flex-col items-center justify-center text-stone-400 hover:text-rose-600 hover:border-rose-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group hover:cursor-pointer">
                    <div class="bg-stone-50 group-hover:bg-rose-50 rounded-full p-4 mb-4 transition-colors">
                        <svg class="size-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    </div>
                    <span class="font-serif text-lg font-medium text-stone-600 group-hover:text-rose-600">Add a new wish</span>
                </button>

                <div x-show="show" x-cloak class="bg-white rounded-3xl shadow-2xl shadow-stone-200/50 border border-stone-100 p-8 animate-in fade-in slide-in-from-bottom-4 duration-500 relative overflow-hidden">
                    <div class="absolute -top-20 -right-20 w-64 h-64 bg-rose-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

                    <div class="flex justify-between items-center mb-8 relative">
                        <div>
                            <h3 class="font-serif text-2xl font-bold text-stone-900">Make a Wish</h3>
                            <p class="text-stone-500 text-sm">Fill in the details for your next gift.</p>
                        </div>
                        <button @click="show = ! show" class="p-2 hover:bg-stone-100 rounded-full transition-colors text-stone-400 hover:text-stone-600 hover:cursor-pointer">
                            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </button>
                    </div>

                    <livewire:frontend.item-form :parentShow.entangle="'show'" />

                </div>
            </div>

            <livewire:frontend.collection-index />
        </div>

    @else
        <h1>Log in</h1>
    @endif
</x-layouts.frontend>
