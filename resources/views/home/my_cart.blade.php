<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        base: '#0c0f14',
                        panel: '#111621',
                        card: '#151b27',
                        accent: '#f59e0b',
                        accent2: '#fb7185',
                        muted: '#9aa4b5'
                    },
                    fontFamily: {
                        sans: ['Inter', 'DM Sans', 'system-ui', 'sans-serif'],
                        display: ['Playfair Display', 'DM Sans', 'serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-base text-white">
    <header class="fixed top-0 inset-x-0 z-50 bg-base/90 backdrop-blur border-b border-white/10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a class="flex items-center gap-3 text-white font-semibold" href="{{ url('/') }}">
                <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-accent2 to-accent grid place-items-center text-base font-bold">RM</span>
                <div class="leading-tight">
                    <div class="text-sm uppercase tracking-wide text-white/70">Restaurant</div>
                    <div class="text-lg">Management</div>
                </div>
            </a>
            <a href="{{ url('/') }}" class="px-4 py-2 rounded-full border border-white/10 text-sm font-semibold text-white hover:border-accent">Back to home</a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-xs uppercase tracking-[0.08em] text-white/70">Your order</p>
                <h1 class="text-3xl font-display leading-tight">Review cart</h1>
            </div>
            <span class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-white/5 border border-white/10 text-sm text-white/80">
                <span class="ti-shopping-cart text-accent"></span>
                {{ count($data) }} items
            </span>
        </div>

        @php $total_price = 0; @endphp

        <div class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 rounded-2xl border border-white/10 bg-card p-4 shadow-lg shadow-black/40 space-y-4">
                @foreach($data as $item)
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 items-center border-b border-white/5 pb-4">
                    <img src="{{ asset('storage/'.$item->image) }}" class="w-full h-28 object-cover rounded-xl border border-white/10">
                    <div class="sm:col-span-2">
                        <div class="text-lg font-semibold">{{ $item->title }}</div>
                        <p class="text-sm text-white/70 line-clamp-2">{{ $item->detail }}</p>
                    </div>
                    <div class="flex sm:flex-col sm:items-end justify-between gap-2">
                        <div class="text-base font-semibold">Rs {{ $item->price }}</div>
                        <a onclick="return confirm('Are you sure to remove this item?')"
                           href="{{ url('remove_cart',$item->id) }}"
                           class="text-sm text-accent hover:underline">Remove</a>
                    </div>
                </div>
                @php $total_price += $item->price; @endphp
                @endforeach
            </div>

            <div class="space-y-4">
                <div class="rounded-2xl border border-white/10 bg-card p-4 shadow-lg shadow-black/40">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-white/70">Subtotal</span>
                        <span class="text-lg font-semibold">Rs {{ $total_price }}</span>
                    </div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm text-white/70">Service</span>
                        <span class="text-sm text-white/70">Included</span>
                    </div>
                    <div class="border-t border-white/10 mt-3 pt-3 flex items-center justify-between">
                        <span class="text-sm font-semibold">Total</span>
                        <span class="text-xl font-bold">Rs {{ $total_price }}</span>
                    </div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-card p-4 shadow-lg shadow-black/40">
                    <h3 class="text-lg font-semibold mb-3">Confirm your order</h3>
                    @if (session()->has('message'))
                        <div class="mb-3 px-3 py-2 rounded-lg bg-emerald-500/10 text-emerald-200 border border-emerald-400/30">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form action="{{url('confirm_order')}}" method="POST" class="space-y-3">
                        @csrf
                        <input type="text" name="name" class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30" value="{{Auth()->user()->name}}" required placeholder="Name">
                        <input type="email" name="email" class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30" value="{{Auth()->user()->email}}" required placeholder="Email">
                        <input type="number" name="phone" class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30" value="{{Auth()->user()->phone}}" required placeholder="Phone">
                        <input type="text" name="address" class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30" value="{{Auth()->user()->address}}" required placeholder="Address">
                        <button type="submit" class="w-full px-4 py-3 rounded-xl bg-gradient-to-br from-accent2 to-accent text-base font-bold text-base/90 hover:shadow-lg hover:shadow-accent/30">
                            Confirm Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="border-t border-white/10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-white/60 text-sm flex justify-between items-center">
            <span>© {{ date('Y') }} Restaurant Manager</span>
            <a href="{{ url('/') }}" class="hover:text-white">Back to menu</a>
        </div>
    </footer>
</body>
</html>
