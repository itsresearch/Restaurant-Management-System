<header class="h-16 border-b border-white/10 bg-panel/80 backdrop-blur flex items-center justify-between px-4 sm:px-6 lg:px-8">
  <div>
    <p class="text-xs uppercase tracking-[0.08em] text-white/60">Admin</p>
    <h1 class="text-lg font-semibold">Dashboard</h1>
  </div>
  <div class="flex items-center gap-3">
    <form method="POST" action="{{ route('logout') }}" class="m-0">
      @csrf
      <button type="submit" class="px-4 py-2 rounded-full bg-gradient-to-br from-accent2 to-accent text-sm font-bold text-base/90 hover:shadow-lg hover:shadow-accent/30">Logout</button>
    </form>
  </div>
</header>