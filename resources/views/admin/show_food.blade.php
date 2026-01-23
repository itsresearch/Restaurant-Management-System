<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Food List</title>
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

    <main class="flex-1 px-4 sm:px-6 lg:px-8 py-8 space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <p class="text-xs uppercase tracking-[0.08em] text-white/60">Menu</p>
                <h2 class="text-2xl font-semibold">Food List</h2>
            </div>
            <a href="{{ url('add_food') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-br from-accent2 to-accent text-sm font-bold text-base/90 hover:shadow-lg hover:shadow-accent/30">Add Food</a>
        </div>

        <div class="rounded-2xl border border-white/10 bg-card p-4 shadow-lg shadow-black/40">
            <div class="overflow-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-left text-white/70">
                        <tr class="border-b border-white/10">
                            <th class="py-3 pr-4">Food Title</th>
                            <th class="py-3 pr-4">Details</th>
                            <th class="py-3 pr-4">Price</th>
                            <th class="py-3 pr-4">Image</th>
                            <th class="py-3 pr-4">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-white/5">
                      @foreach($data as $data)
                        <tr>
                            <td class="py-3 pr-4 font-semibold">{{ $data->title }}</td>
                            <td class="py-3 pr-4 text-white/70">{{ $data->detail }}</td>
                            <td class="py-3 pr-4">Rs {{ $data->price }}</td>
                            <td class="py-3 pr-4">
                                <img class="w-20 h-14 object-cover rounded-lg border border-white/10" src="{{ asset('storage/'.$data->image) }}" alt="">
                            </td>
                            <td class="py-3 pr-4 space-x-2">
                              <a href="{{url('delete_food',$data->id)}}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-xs hover:border-accent2" onclick="return confirm('Are you sure?')">Delete</a>
                              <a class="inline-flex items-center px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-xs hover:border-accent" href="{{url('update_food',$data->id)}}">Update</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

</body>
</html>
