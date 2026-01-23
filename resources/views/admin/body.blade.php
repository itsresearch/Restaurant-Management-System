<div class="py-8 space-y-8">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
    <div>
      <p class="text-xs uppercase tracking-[0.08em] text-white/60">Overview</p>
      <h2 class="text-2xl font-semibold">Key metrics</h2>
    </div>
    <a href="{{ url('orders') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-br from-accent2 to-accent text-sm font-bold text-base/90 hover:shadow-lg hover:shadow-accent/30">
      View Orders
    </a>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
    <div class="rounded-2xl border border-white/10 bg-card p-4 shadow-lg shadow-black/40">
      <div class="flex items-center justify-between mb-4">
        <div class="text-white/80 text-sm">Total Users</div>
        <span class="w-10 h-10 rounded-xl bg-white/5 grid place-items-center text-accent"><i class="ti-user"></i></span>
      </div>
      <div class="text-3xl font-bold">{{$total_user}}</div>
      <p class="text-xs text-white/60 mt-2">Active customers and staff</p>
    </div>
    <div class="rounded-2xl border border-white/10 bg-card p-4 shadow-lg shadow-black/40">
      <div class="flex items-center justify-between mb-4">
        <div class="text-white/80 text-sm">Total Foods</div>
        <span class="w-10 h-10 rounded-xl bg-white/5 grid place-items-center text-accent"><i class="ti-layout-grid2"></i></span>
      </div>
      <div class="text-3xl font-bold">{{$total_food}}</div>
      <p class="text-xs text-white/60 mt-2">Items listed on the menu</p>
    </div>
    <div class="rounded-2xl border border-white/10 bg-card p-4 shadow-lg shadow-black/40">
      <div class="flex items-center justify-between mb-4">
        <div class="text-white/80 text-sm">Total Orders</div>
        <span class="w-10 h-10 rounded-xl bg-white/5 grid place-items-center text-accent"><i class="ti-receipt"></i></span>
      </div>
      <div class="text-3xl font-bold">{{$total_order}}</div>
      <p class="text-xs text-white/60 mt-2">Orders placed</p>
    </div>
    <div class="rounded-2xl border border-white/10 bg-card p-4 shadow-lg shadow-black/40">
      <div class="flex items-center justify-between mb-4">
        <div class="text-white/80 text-sm">Total Delivered</div>
        <span class="w-10 h-10 rounded-xl bg-white/5 grid place-items-center text-accent"><i class="ti-truck"></i></span>
      </div>
      <div class="text-3xl font-bold">{{$total_delivered}}</div>
      <p class="text-xs text-white/60 mt-2">Completed and delivered</p>
    </div>
  </div>

  <div class="rounded-2xl border border-white/10 bg-card p-6 shadow-lg shadow-black/40">
    <h3 class="text-lg font-semibold mb-3">Quick actions</h3>
    <div class="grid sm:grid-cols-3 gap-3">
      <a href="{{ url('add_food') }}" class="rounded-xl border border-white/10 bg-white/5 px-4 py-3 flex items-center gap-3 hover:border-accent">
        <span class="ti-plus text-accent"></span>
        <div>
          <div class="font-semibold">Add new dish</div>
          <p class="text-xs text-white/60">Create and publish a menu item</p>
        </div>
      </a>
      <a href="{{ url('view_food') }}" class="rounded-xl border border-white/10 bg-white/5 px-4 py-3 flex items-center gap-3 hover:border-accent">
        <span class="ti-layout-grid2 text-accent"></span>
        <div>
          <div class="font-semibold">Manage menu</div>
          <p class="text-xs text-white/60">Edit pricing and availability</p>
        </div>
      </a>
      <a href="{{ url('reservation') }}" class="rounded-xl border border-white/10 bg-white/5 px-4 py-3 flex items-center gap-3 hover:border-accent">
        <span class="ti-calendar text-accent"></span>
        <div>
          <div class="font-semibold">Reservations</div>
          <p class="text-xs text-white/60">Review and confirm tables</p>
        </div>
      </a>
    </div>
  </div>
</div>

        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
               <p class="no-margin-bottom">2018 &copy; Research Devkota</p>
            </div>
          </div>
        </footer>