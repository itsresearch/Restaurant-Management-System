<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Food</title>
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
                    <h2 class="text-2xl font-semibold">Add new dish</h2>
                </div>

                <div class="rounded-2xl border border-white/10 bg-card p-6 shadow-lg shadow-black/40">
                    <form action="{{url('upload_food')}}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="space-y-2">
                            <label class="text-sm text-white/70">Food title</label>
                            <input type="text" name="title" required class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-white/70">Food details</label>
                            <textarea name="details" rows="5" required class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30"></textarea>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-sm text-white/70">Price</label>
                                <input type="number" name="price" step="0.01" required class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-3 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent/30">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm text-white/70">Image</label>
                                <input type="file" name="img" required class="w-full rounded-xl bg-base/70 border border-white/10 px-4 py-2 text-white focus:border-accent focus:ring-2 focus:ring-accent/30">
                            </div>
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-5 py-3 rounded-xl bg-gradient-to-br from-accent2 to-accent text-base font-bold text-base/90 hover:shadow-lg hover:shadow-accent/30">
                            Add Food
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
