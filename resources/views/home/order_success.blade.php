<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="min-h-screen bg-gray-50 py-16">
        <div class="max-w-4xl mx-auto px-4">

            <!-- Success Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

                <!-- Success Icon -->
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-3xl font-bold mb-2 text-green-600">
                    Order Placed Successfully 🎉
                </h1>

                <p class="text-gray-600 mb-8">
                    Thank you for your order{{ $user ? ', ' . $user->name : '' }}! Your food is being prepared.
                </p>

                <!-- Order Details -->
                <div class="bg-gray-100 rounded-xl p-6 text-left mb-8">

                    <h2 class="text-xl font-semibold mb-4 text-gray-900">
                        Order Details
                    </h2>

                    <div class="space-y-3">
                        @php $total = 0; @endphp
                        @if (isset($orders) && $orders->count() > 0)
                            @foreach ($orders as $order)
                                <div
                                    class="flex justify-between items-center py-2 border-b border-gray-200 last:border-b-0">
                                    <div>
                                        <span class="font-medium">{{ $order->title }}</span>
                                        <p class="text-sm text-gray-600">Qty: {{ $order->quantity }}</p>
                                    </div>
                                    <span class="font-medium text-blue-600">
                                        ${{ number_format($order->price, 2) }}
                                    </span>
                                </div>
                                @php $total += $order->price; @endphp
                            @endforeach
                            <div class="flex justify-between items-center pt-4 border-t border-gray-300">
                                <span class="font-semibold">Total</span>
                                <span class="font-semibold text-green-600">${{ number_format($total, 2) }}</span>
                            </div>
                        @else
                            <p class="text-gray-600">No order details available.</p>
                        @endif
                    </div>

                    <div class="mt-4 text-sm text-gray-600">
                        <p>Estimated Time: ⏱ About 5 minutes</p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/') }}"
                        class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                        Back to Home
                    </a>

                    <a href="{{ url('/my_cart') }}"
                        class="px-6 py-3 rounded-xl border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                        View My Orders
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
