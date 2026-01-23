<div class="grid lg:grid-cols-5 gap-6">
    <div class="lg:col-span-2 rounded-2xl border border-white/10 bg-gradient-to-br from-accent/10 to-accent2/10 p-6 shadow-lg shadow-black/40">
        <p class="text-xs uppercase tracking-[0.08em] text-white/70">Book a table</p>
        <h3 class="text-2xl font-display leading-tight mt-2 mb-4">Reserve your experience</h3>
        <form action="{{url('book_table')}}" method="POST" class="space-y-3">
            @csrf
            <input type="text" name="name" placeholder="Name" class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30">
            
            <input type="text" name="phone" placeholder="Phone Number" class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30">
            <input type="number" name="a_guest" min="1" max="20" placeholder="Number of guests" class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30">
            <div class="grid grid-cols-2 gap-3">
                <input type="time" name="time" class="rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30">
                <input type="date" name="date" class="rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30">
            </div>
            <button type="submit" class="w-full px-4 py-3 rounded-xl bg-gradient-to-br from-accent2 to-accent text-base font-bold text-base/90 hover:shadow-lg hover:shadow-accent/30">Book Now</button>
        </form>
    </div>

    <div class="lg:col-span-3">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-xs uppercase tracking-[0.08em] text-white/70">Our menu</p>
                <h2 class="text-3xl font-display leading-tight">Guest favorites</h2>
            </div>
            @if (session()->has('message'))
                <div class="text-sm px-3 py-2 rounded-full bg-emerald-500/10 text-emerald-200 border border-emerald-400/30">
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>

        <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($data as $data)
            <div class="relative rounded-2xl border border-white/10 bg-card shadow-lg shadow-black/40 overflow-hidden flex flex-col">
                <div class="h-40">
                    <img src="{{ asset('storage/'.$data->image) }}" alt="{{ $data->title }}" class="w-full h-full object-cover">
                </div>
                <div class="absolute top-3 right-3 px-3 py-1 rounded-full bg-base/90 border border-white/10 text-sm font-semibold">
                    Rs {{ $data->price }}
                </div>
                <div class="p-4 flex flex-col gap-2 flex-1">
                    <h4 class="text-lg font-semibold">{{ $data->title }}</h4>
                    <p class="text-sm text-white/70 line-clamp-3">{{ $data->detail }}</p>
                    <form action="{{url('add_cart',$data->id)}}" method="post" class="mt-auto flex items-center gap-2 pt-2">
                        @csrf
                        <input value="1" type="number" min="1" name="qty" required class="w-20 rounded-lg bg-base/70 border border-white/10 px-3 py-2 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30">
                        <button type="submit" class="flex-1 px-4 py-2 rounded-lg bg-gradient-to-br from-accent2 to-accent text-sm font-bold text-base/90 hover:shadow-md hover:shadow-accent/30">Add to cart</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
