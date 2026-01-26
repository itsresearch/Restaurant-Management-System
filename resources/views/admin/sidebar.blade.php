<aside class="w-64 bg-panel border-r border-white/10 min-h-screen hidden md:flex flex-col">
  <div class="px-4 py-5 border-b border-white/10">
    <div class="flex items-center gap-3">
      <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-accent2 to-accent grid place-items-center text-base font-bold text-base/90">AD</div>
      <div>
        <p class="text-sm font-semibold">Admin Portal</p>
        <p class="text-xs text-white/60">Restaurant Manager</p>
      </div>
    </div>
  </div>
  <nav class="flex-1 px-3 py-4 space-y-1 text-sm font-semibold text-white/70">
    <a href="{{ url('home') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 hover:text-white">
      <span class="ti-home"></span> Home
    </a>
    <div class="pt-2">
      <p class="px-3 text-xs uppercase tracking-[0.08em] text-white/50 mb-2">Food</p>
      {{-- <a href="{{ url('add_food') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 hover:text-white">
        <span class="ti-plus"></span> Add Food
      </a> --}}
      <a href="{{ url('view_food') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 hover:text-white">
        <span class="ti-layout-grid2"></span> View Food
      </a>
    </div>
    <a href="{{ url('orders') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 hover:text-white">
      <span class="ti-receipt"></span> Orders
    </a>
    <a href="{{ url('reservation') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/5 hover:text-white">
      <span class="ti-calendar"></span> Reservation
    </a>
  </nav>
</aside>