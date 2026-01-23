<header class="fixed top-0 inset-x-0 z-50 bg-base/90 backdrop-blur border-b border-white/10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <a class="flex items-center gap-3 text-white font-semibold" href="{{ url('/') }}">
            <span class="w-11 h-11 rounded-xl bg-gradient-to-br from-accent2 to-accent grid place-items-center text-base font-bold">RM</span>
            <div class="leading-tight">
                <div class="text-sm uppercase tracking-wide text-white/70">Restaurant</div>
                <div class="text-lg">Management</div>
            </div>
        </a>

        <nav class="hidden md:flex items-center gap-2 text-sm font-semibold text-white/70">
            <a href="#home" class="px-3 py-2 rounded-full hover:bg-white/5 hover:text-white">Home</a>
            <a href="#about" class="px-3 py-2 rounded-full hover:bg-white/5 hover:text-white">About</a>
            <a href="#blog" class="px-3 py-2 rounded-full hover:bg-white/5 hover:text-white">Menu</a>
            <a href="#gallary" class="px-3 py-2 rounded-full hover:bg-white/5 hover:text-white">Gallery</a>
            <a href="#contact" class="px-3 py-2 rounded-full hover:bg-white/5 hover:text-white">Contact</a>
        </nav>

        <div class="flex items-center gap-2">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('my_cart') }}" class="hidden sm:inline-flex items-center gap-2 px-3 py-2 rounded-full border border-white/10 text-sm font-semibold text-white hover:border-accent">
                        <span class="ti-shopping-cart"></span> Cart
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-full bg-gradient-to-br from-accent2 to-accent text-base font-bold text-base/90 hover:shadow-lg hover:shadow-accent/30">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 rounded-full border border-white/10 text-sm font-semibold text-white hover:border-accent">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-gradient-to-br from-accent2 to-accent text-base font-bold text-base/90 hover:shadow-lg hover:shadow-accent/30">Register</a>
                @endauth
            @endif
        </div>
    </div>
</header>