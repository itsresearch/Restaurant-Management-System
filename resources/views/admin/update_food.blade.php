<!DOCTYPE html>
<html lang="en">
  <head> 
    <base href="/public">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update Food</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              base: '#0f172a',
              panel: '#111827',
              card: '#1f2937',
              accent: '#f59e0b',
              accent2: '#fb7185',
              muted: '#9ca3af'
            },
            fontFamily: {
              sans: ['Inter', 'DM Sans', 'system-ui', 'sans-serif']
            }
          }
        }
      }
    </script>
  </head>
  <body class="bg-base text-white">
@include('admin.header')
    <div class="flex min-h-screen">
@include('admin.sidebar')
<main class="flex-1 px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-3xl mx-auto space-y-6">
        <div>
            <p class="text-xs uppercase tracking-[0.08em] text-white/60">Menu</p>
            <h1 class="text-2xl font-semibold">Update Food</h1>
        </div>

        <div class="rounded-2xl border border-white/10 bg-card p-6 shadow-lg shadow-black/40">
<form action="{{ url('edit_food', $food->id) }}" method="post" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div class="space-y-2">
        <label class="text-sm text-white/70">Food Title</label>
        <input type="text" name="title" class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30"
               value="{{ $food->title }}" required>
    </div>

    <div class="space-y-2">
        <label class="text-sm text-white/70">Food Description</label>
        <textarea name="detail" class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30" rows="4" required>{{ $food->detail }}</textarea>
    </div>

    <div class="space-y-2">
        <label class="text-sm text-white/70">Price</label>
        <input type="number" step="0.01" name="price" class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30"
               value="{{ $food->price }}" required>
    </div>

    <div class="space-y-2">
        <label class="text-sm text-white/70">Current Image</label><br>
        <img src="{{ asset('storage/'.$food->image) }}"
             class="w-28 h-28 object-cover rounded-xl border border-white/10">
    </div>

    <div class="space-y-2">
        <label class="text-sm text-white/70">Change Image</label>
        <input type="file" name="image" class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-2 text-white focus:border-accent focus:ring-2 focus:ring-accent/30">
    </div>

    <button type="submit" class="px-5 py-3 rounded-xl bg-gradient-to-br from-accent2 to-accent text-base font-bold text-base/90 hover:shadow-lg hover:shadow-accent/30">
        Update Food
    </button>
</form>
        </div>
    </div>
</main>
    </div>
  </body>
</html>