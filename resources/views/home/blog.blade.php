<div class="grid lg:grid-cols-5 gap-6">

    <!-- Booking Form -->
    <div id="blog"
        class="lg:col-span-2 rounded-2xl border border-white/10 bg-gradient-to-br from-accent/10 to-accent2/10 p-6 shadow-lg shadow-black/40">
        <p class="text-xs uppercase tracking-[0.08em] text-white/70">Book a table</p>
        <h3 class="text-2xl font-display leading-tight mt-2 mb-4">Reserve your experience</h3>

        <!-- Messages -->
        @if (session('success'))
            <div
                class="text-sm px-3 py-2 rounded-full bg-emerald-500/20 text-emerald-700 border border-emerald-400/30 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="text-sm px-3 py-2 rounded-full bg-red-500/20 text-red-700 border border-red-400/30 mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="text-sm px-3 py-2 rounded-full bg-red-500/20 text-red-700 border border-red-400/30 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Scroll to section if message exists -->
        @if (session('success') || session('error') || $errors->any())
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const section = document.querySelector("#blog");
                    if (section) {
                        section.scrollIntoView({
                            behavior: "smooth"
                        });
                    }
                });
            </script>
        @endif

        <!-- Booking Form -->
        <form action="{{ url('book_table') }}" method="POST" class="space-y-3">
            @csrf
            <input type="text" name="name" placeholder="Name"
                value="{{ Auth::check() ? Auth::user()->name : '' }}"
                class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30">
            <input type="text" name="phone" value="{{ Auth::check() ? Auth::user()->phone : '' }}"
                placeholder="Phone Number"
                class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30">
            <input type="email" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}"
                placeholder="Email Address"
                class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30">
            <input type="number" name="a_guest" min="1" max="20" placeholder="Number of guests"
                class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30">
            <div class="grid grid-cols-2 gap-3">
    <!-- Date -->
    <input 
        type="text" 
        id="booking_date"
        name="date"
        placeholder="Select date"
        class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30"
    >

    <!-- Time -->
    <input 
        type="text"
        id="booking_time"
        name="time"
        placeholder="Select time"
        class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30"
    >
</div>

            <button type="submit"
                class="w-full px-4 py-3 rounded-xl bg-gradient-to-br from-accent2 to-accent text-base font-bold text-base/90 hover:shadow-lg hover:shadow-accent/30">Book
                Now</button>
        </form>
    </div>

    <!-- Menu / Cart -->
    <div class="lg:col-span-3">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-xs uppercase tracking-[0.08em] text-white/70">Our menu</p>
                <h2 class="text-3xl font-display leading-tight">Guest favorites</h2>
            </div>

            @if (session('cart_success'))
                <div
                    class="text-sm px-3 py-2 rounded-full bg-emerald-500/20 text-emerald-700 border border-emerald-400/30">
                    {{ session('cart_success') }}
                </div>
            @endif
        </div>

        <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach ($data as $data)
                <div
                    class="relative rounded-2xl border border-white/10 bg-card shadow-lg shadow-black/40 overflow-hidden flex flex-col">
                    <div class="h-40">
                        <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->title }}"
                            class="w-full h-full object-cover">
                    </div>
                    <div
                        class="absolute top-3 right-3 px-3 py-1 rounded-full bg-base/90 border border-white/10 text-sm font-semibold">
                        Rs {{ $data->price }}
                    </div>
                    <div class="p-4 flex flex-col gap-2 flex-1">
    <h4 class="text-lg font-semibold">{{ $data->title }}</h4>
    <p class="text-sm text-white/70 line-clamp-3">{{ $data->detail }}</p>

    <form action="{{ url('add_cart', $data->id) }}" method="POST"
        class="mt-auto flex items-center gap-2 pt-2">
        @csrf

        <!-- Quantity (hidden initially) -->
        <input 
            type="number" 
            name="qty" 
            min="1" 
            value="1"
            class="qty-input hidden w-20 rounded-lg bg-base/70 border border-white/10 px-3 py-2 text-white focus:border-accent focus:ring-2 focus:ring-accent/30"
        >

        <!-- Add to cart button -->
        @if(Auth::check())
    <button type="submit"
        class="w-full px-4 py-3 rounded-xl bg-gradient-to-br from-accent2 to-accent text-base font-bold hover:shadow-lg hover:shadow-accent/30">
        Book Now
    </button>
@else
    <a href="{{ route('login') }}"
       class="block text-center w-full px-4 py-3 rounded-xl bg-gradient-to-br from-accent2 to-accent text-base font-bold hover:shadow-lg hover:shadow-accent/30">
        Login to Book Table
    </a>
@endif

    </form>
</div>

                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        // Date Picker
        flatpickr("#booking_date", {
            dateFormat: "Y-m-d",
            minDate: "today",
            disableMobile: true
        });

        // Time Picker
        flatpickr("#booking_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: false,
            minuteIncrement: 15,
            disableMobile: true
        });

    });
</script>

{{--  for add to cart option. --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll(".add-to-cart-btn").forEach(button => {
            button.addEventListener("click", function () {

                const form = this.closest("form");
                const qtyInput = form.querySelector(".qty-input");
                const submitBtn = form.querySelector(".submit-btn");

                // Show quantity + confirm button
                qtyInput.classList.remove("hidden");
                submitBtn.classList.remove("hidden");

                // Hide add to cart button
                this.classList.add("hidden");
            });
        });

    });
</script>


