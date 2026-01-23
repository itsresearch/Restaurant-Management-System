<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <title>Admin | Orders</title>
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
                <p class="text-xs uppercase tracking-[0.08em] text-white/60">Orders</p>
                <h2 class="text-2xl font-semibold">All orders</h2>
            </div>
        </div>

        <div class="rounded-2xl border border-white/10 bg-card p-4 shadow-lg shadow-black/40">
            <div class="overflow-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-left text-white/70">
                        <tr class="border-b border-white/10">
                            <th class="py-3 pr-4">Customer</th>
                            <th class="py-3 pr-4">Email</th>
                            <th class="py-3 pr-4">Phone</th>
                            <th class="py-3 pr-4">Address</th>
                            <th class="py-3 pr-4">Food</th>
                            <th class="py-3 pr-4">Qty</th>
                            <th class="py-3 pr-4">Price</th>
                            <th class="py-3 pr-4">Image</th>
                            <th class="py-3 pr-4">Status</th>
                            <th class="py-3 pr-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($data as $data)
                        <tr>
                            <td class="py-3 pr-4 font-semibold">{{ $data->name }}</td>
                            <td class="py-3 pr-4 text-white/70">{{ $data->email }}</td>
                            <td class="py-3 pr-4 text-white/70">{{ $data->phone }}</td>
                            <td class="py-3 pr-4 text-white/70">{{ $data->address }}</td>
                            <td class="py-3 pr-4">{{ $data->food_name }}</td>
                            <td class="py-3 pr-4">{{ $data->quantity }}</td>
                            <td class="py-3 pr-4">Rs {{ $data->price }}</td>
                            <td class="py-3 pr-4">
                                <img src="{{ asset('storage/'.$data->image) }}" class="w-16 h-12 object-cover rounded-lg border border-white/10">
                            </td>
                            <td class="py-3 pr-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/5 border border-white/10">{{ $data->delivery_status }}</span>
                            </td>
                            <td class="py-3 pr-4 space-x-2">
                                <a onclick="return confirm('Are you sure to change this?')" href="{{url('on_the _way',$data->id)}}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-xs hover:border-accent">On the Way</a>
                                <a onclick="return confirm('Are you sure to change this?')" href="{{url('delivered',$data->id)}}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-xs hover:border-accent">Delivered</a>
                                <a onclick="return confirm('Are you sure to change this?')" href="{{url('canceled',$data->id)}}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-xs hover:border-accent2">Cancel</a>
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
