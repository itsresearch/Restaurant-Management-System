<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin | Table Bookings</title>
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
                    <p class="text-xs uppercase tracking-[0.08em] text-white/60">Bookings</p>
                    <h2 class="text-2xl font-semibold">Table reservations</h2>
                </div>
            </div>

            <div class="rounded-2xl border border-white/10 bg-card p-4 shadow-lg shadow-black/40">
                <div class="overflow-auto">
                    <table class="min-w-full text-sm">
                        <thead class="text-left text-white/70">
                            <tr class="border-b border-white/10">
                                <th class="py-3 pr-4">Name</th>
                                <th class="py-3 pr-4">Phone Number</th>
                                <th class="py-3 pr-4">Email</th>
                                <th class="py-3 pr-4">Guests</th>
                                <th class="py-3 pr-4">Date</th>
                                <th class="py-3 pr-4">Time</th>
                                <th class="py-3 pr-4">Status</th>
                                <th class="py-3 pr-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach ($book as $booking)
                                <tr>
                                    <td class="py-3 pr-4 font-semibold">{{ $booking->name }}</td>
                                    <td class="py-3 pr-4 font-semibold">{{ $booking->phone }}</td>
                                    <td class="py-3 pr-4 font-semibold">{{ $booking->email }}</td>
                                    <td class="py-3 pr-4">{{ $booking->guest }}</td>
                                    <td class="py-3 pr-4 text-white/70">{{ $booking->date }}</td>
                                    <td class="py-3 pr-4 text-white/70">{{ $booking->time }}</td>
                                    <td class="py-3 pr-4 text-white/70">{{ ucfirst($booking->status) }}</td>
                                    <td class="py-3 pr-4 space-x-2">
                                        @if ($booking->status == 'pending')
                                            <form method="POST" action="{{ url('booking/'.$booking->id.'/accept') }}" class="inline" onsubmit="return confirm('Are you sure you want to accept this booking?')">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-xs hover:border-accent2">
                                                    Accept
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ url('booking/'.$booking->id.'/reject') }}" class="inline" onsubmit="return confirm('Are you sure you want to reject this booking?')">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-white/5 border border-white/10 text-xs hover:border-accent">
                                                    Reject
                                                </button>
                                            </form>
                                        @endif
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
