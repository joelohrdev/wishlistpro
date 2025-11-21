<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FAFAF9; /* Stone 50 */
        }
        h1, h2, h3, h4, .font-serif {
            font-family: 'Playfair Display', serif;
        }
        /* Custom scrollbar for a cleaner look */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #d6d3d1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a29e;
        }
    </style>
    @fluxAppearance
</head>
<body class="text-stone-800 antialiased">
    <div class="min-h-screen flex flex-col bg-[#FAFAF9]">
        {{--Navigation--}}
        <nav class="sticky top-0 z-50 bg-[#FAFAF9]/80 backdrop-blur-md border-b border-stone-200/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center gap-2 group cursor-pointer">
                            <div class="bg-rose-500 text-white p-2 rounded-xl shadow-lg shadow-rose-200 group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/></svg>
                            </div>
                            <span class="font-serif font-bold text-2xl text-stone-900 tracking-light">
                                Wishlist<span class="text-rose-500 italic">Pro</span>
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center">
                        @if(auth()->user())
                            <flux:dropdown>
                                <flux:profile circle :name="auth()->user()->name" />
                                <flux:menu>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <flux:navmenu.item as="button" type="submit" icon="arrow-right-start-on-rectangle">Logout</flux:navmenu.item>
                                    </form>
                                </flux:menu>
                            </flux:dropdown>
                        @else
                            <flux:button variant="filled" href="{{ route('login') }}">Login</flux:button>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
            <div class="max-w-5xl mx-auto space-y-10">
                {{ $slot }}
            </div>
        </main>

        <footer class="border-t border-stone-200 mt-auto bg-white">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center flex-col md:flex-row gap-4">
                    <div class="flex items-center gap-2 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/></svg>
                        <span class="font-serif font-semibold">WishList Pro</span>
                    </div>
                    <p class="text-center text-sm text-stone-400">
                        &copy; {{ now()->year }} Crafted for memories.
                    </p>
                </div>
            </div>
        </footer>
    </div>
    @fluxScripts
    @persist('toast')
    <flux:toast />
    @endpersist
</body>
</html>
