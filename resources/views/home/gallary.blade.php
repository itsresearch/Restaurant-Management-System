<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-xs uppercase tracking-[0.08em] text-white/70">Gallery</p>
        <h2 class="text-3xl font-display leading-tight">Moments from the kitchen</h2>
    </div>
</div>
<div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
    @foreach($data as $data)
    <div class="group relative rounded-2xl overflow-hidden border border-white/10 bg-card shadow-lg shadow-black/40">
        <img src="{{ asset('storage/'.$data->image) }}" alt="Food" class="w-full h-56 object-cover transition duration-300 group-hover:scale-105">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
            <div>
                <p class="text-sm text-white/80">Signature Dish</p>
                <p class="font-semibold text-lg">{{ $data->title ?? 'Featured' }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>