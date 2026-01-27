<div class="grid lg:grid-cols-5 gap-6">

    <!-- ================= BOOKING FORM ================= -->
    <div id="blog"
        class="lg:col-span-2 rounded-2xl border border-white/10 bg-gradient-to-br from-accent/10 to-accent2/10 p-6 shadow-lg shadow-black/40">

        <p class="text-xs uppercase tracking-[0.08em] text-white/70">Book a table</p>
        <h3 class="text-2xl font-display leading-tight mt-2 mb-4">Reserve your experience</h3>

        <!-- Messages -->
@if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                icon: 'success',
                title: 'Booking Confirmed!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#22c55e', // green
            });
        });
    </script>
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

        <!-- Auto scroll -->
        @if (session('success') || session('error') || $errors->any())
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    document.getElementById("blog")?.scrollIntoView({ behavior: "smooth" });
                });
            </script>
        @endif

        <!-- Booking Form -->
        <form action="{{ url('book_table') }}" method="POST" class="space-y-3">
            @csrf

            <input type="text" name="name"
                value="{{ Auth::check() ? Auth::user()->name : '' }}"
                placeholder="Name"
                class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white">

            <input type="text" name="phone"
                value="{{ Auth::check() ? Auth::user()->phone : '' }}"
                placeholder="Phone Number"
                class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white">

            <input type="email" name="email"
                value="{{ Auth::check() ? Auth::user()->email : '' }}"
                placeholder="Email Address"
                class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white">

            <input type="number" name="a_guest" min="1" max="20"
                placeholder="Number of guests"
                class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white">

            <div class="grid grid-cols-2 gap-3">
                <input type="text" id="booking_date" name="date"
                    placeholder="Select date"
                    class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white">

                <input type="text" id="booking_time" name="time"
                    placeholder="Select time"
                    class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white">
            </div>

            @if(Auth::check())
                <button type="submit"
    class="w-full px-4 py-3 rounded-xl bg-gradient-to-br from-accent2 to-accent 
           font-bold text-black hover:shadow-lg">
    Book Now
</button>

            @else
               <a href="{{ route('login') }}"
   class="block text-center w-full px-4 py-3 rounded-xl bg-gradient-to-br 
          from-accent2 to-accent font-bold text-black hover:shadow-lg">
    Login to Book Table
</a>

            @endif
        </form>
    </div>

    <!-- ================= MENU / CART ================= -->
    <div class="lg:col-span-3">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-xs uppercase tracking-[0.08em] text-white/70">Our menu</p>
                <h2 class="text-3xl font-display leading-tight">Guest favorites</h2>
            </div>

            @if (session('cart_success'))
                <div class="text-sm px-3 py-2 rounded-full bg-emerald-500/20 text-emerald-700 border border-emerald-400/30">
                    {{ session('cart_success') }}
                </div>
            @endif
        </div>

        <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach ($data as $item)
                <div class="rounded-2xl border border-white/10 bg-card shadow-lg overflow-hidden flex flex-col">

                    <div class="h-40">
                        <img src="{{ asset('storage/' . $item->image) }}"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="absolute top-3 right-3 px-3 py-1 rounded-full bg-base/90 text-sm font-semibold">
                        Rs {{ $item->price }}
                    </div>

                    <div class="p-4 flex flex-col gap-2 flex-1">
                        <h4 class="text-lg font-semibold">{{ $item->title }}</h4>
                        <p class="text-sm text-white/70 line-clamp-3">{{ $item->detail }}</p>

                        <form action="{{ url('add_cart', $item->id) }}" method="POST"
                            class="mt-auto flex items-center gap-2 pt-2">
                            @csrf

                            <input type="number" name="qty" min="1" value="1"
                                class="qty-input hidden w-20 rounded-lg bg-base/70 border border-white/10 px-3 py-2 text-white">

                            <button type="button"
    class="add-to-cart-btn flex-1 px-4 py-2 rounded-lg 
           bg-gradient-to-br from-accent2 to-accent font-bold text-black">
    Add to cart
</button>


                            <button type="submit"
    class="submit-btn hidden px-4 py-2 rounded-lg bg-emerald-500 
           font-bold text-black">
    Confirm
</button>

                        </form>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- ================= SCRIPTS ================= -->

<script>
document.addEventListener("DOMContentLoaded", function () {

    flatpickr("#booking_date", {
        dateFormat: "Y-m-d",
        minDate: "today",
        disableMobile: true
    });

    flatpickr("#booking_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K",
        minuteIncrement: 15,
        disableMobile: true
    });

    document.querySelectorAll(".add-to-cart-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const form = this.closest("form");
            form.querySelector(".qty-input").classList.remove("hidden");
            form.querySelector(".submit-btn").classList.remove("hidden");
            this.classList.add("hidden");
        });
    });

});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

