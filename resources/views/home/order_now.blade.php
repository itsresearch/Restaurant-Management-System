@extends('layouts.app')

@section('content')
    @if (session('message'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('message') }}
        </div>
    @endif
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <h1 class="text-3xl font-bold text-gray-900">Order Now</h1>
                    <div class="flex items-center space-x-4">
                        <button id="cart-toggle"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                            Cart (<span id="cart-count">0</span>)
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex">
                <!-- Main Content -->
                <div class="flex-1 pr-8">
                    <!-- Search and Filter -->
                    <div class="mb-8">
                        <input type="text" id="search" placeholder="Search for food..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="mt-4 flex space-x-4">
                            <button class="category-btn bg-blue-600 text-white px-4 py-2 rounded-lg"
                                data-category="all">All</button>
                            <button class="category-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg"
                                data-category="appetizers">Appetizers</button>
                            <button class="category-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg"
                                data-category="mains">Mains</button>
                            <button class="category-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg"
                                data-category="desserts">Desserts</button>
                            <button class="category-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg"
                                data-category="drinks">Drinks</button>
                        </div>
                    </div>

                    <!-- Food Items Grid -->
                    <div id="food-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($foods ?? [] as $food)
                            <div class="food-item bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200"
                                data-category="{{ $food->category ?? 'mains' }}" data-id="{{ $food->id }}">
                                <img src="{{ $food->image ?? 'https://via.placeholder.com/300x200' }}"
                                    alt="{{ $food->name }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $food->name }}</h3>
                                    <p class="text-gray-600 mt-2">{{ $food->description ?? 'Delicious food item' }}</p>
                                    <div class="flex justify-between items-center mt-4">
                                        <span class="text-2xl font-bold text-green-600">${{ $food->price }}</span>
                                        <button
                                            class="add-to-cart bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200"
                                            data-food-id="{{ $food->id }}" data-name="{{ $food->name }}"
                                            data-price="{{ $food->price }}">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Cart Sidebar -->
                <div id="cart-sidebar" class="w-80 bg-white shadow-lg rounded-lg p-6 hidden">
                    <h2 class="text-2xl font-bold mb-4">Your Cart</h2>
                    <form method="POST" action="{{ url('/confirm_order') }}">
                        @csrf
                        <!-- User Details -->
                        <div class="mb-4 space-y-2">
                            <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}"
                                placeholder="Full Name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}"
                                placeholder="Email" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <input type="text" name="phone" placeholder="Phone" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <textarea name="address" placeholder="Delivery Address" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" rows="3"></textarea>
                        </div>
                        <div id="cart-items" class="space-y-4">
                            <!-- Cart items will be added here -->
                        </div>
                        <div class="border-t pt-4 mt-4">
                            <div class="flex justify-between text-lg font-semibold">
                                <span>Total:</span>
                                <span id="cart-total">$0.00</span>
                            </div>
                            <button type="submit"
                                class="w-full bg-green-600 text-white py-2 rounded-lg mt-4 hover:bg-green-700 transition duration-200">
                                Confirm Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Notification Popup -->
        <div id="notification"
            class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 hidden">
            <p id="notification-text"></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cart = [];
            const cartCount = document.getElementById('cart-count');
            const cartItems = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');
            const cartSidebar = document.getElementById('cart-sidebar');
            const cartToggle = document.getElementById('cart-toggle');
            const checkoutBtn = document.getElementById('checkout-btn');
            const notification = document.getElementById('notification');
            const notificationText = document.getElementById('notification-text');
            const searchInput = document.getElementById('search');
            const categoryButtons = document.querySelectorAll('.category-btn');
            const foodItems = document.querySelectorAll('.food-item');

            // Toggle cart sidebar
            cartToggle.addEventListener('click', function() {
                cartSidebar.classList.toggle('hidden');
            });

            // Add to cart
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('add-to-cart')) {
                    const foodId = e.target.dataset.foodId;
                    const name = e.target.dataset.name;
                    const price = parseFloat(e.target.dataset.price);

                    // AJAX request to add to cart
                    fetch(`/add_cart/${foodId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: 'qty=1'
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update cart count in navbar
                                const cartCountElement = document.getElementById('cart-count');
                                if (cartCountElement) {
                                    cartCountElement.textContent = data.cart_count;
                                }

                                // Highlight the card
                                const card = e.target.closest('.food-item');
                                card.classList.add('ring-2', 'ring-green-500');
                                setTimeout(() => {
                                    card.classList.remove('ring-2', 'ring-green-500');
                                }, 2000);

                                // Show notification
                                showNotification(`${name} added to cart!`);
                            } else {
                                showNotification(data.message ||
                                    'Failed to add to cart. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification('An error occurred. Please try again.');
                        });
                }
            });

            // Update cart display
            function updateCart() {
                cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
                cartItems.innerHTML = '';
                let total = 0;

                cart.forEach(item => {
                    total += item.price * item.quantity;
                    cartItems.innerHTML += `
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="font-semibold">${item.name}</h4>
                        <p class="text-sm text-gray-600">Qty: ${item.quantity}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>$${(item.price * item.quantity).toFixed(2)}</span>
                        <button class="remove-item text-red-600 hover:text-red-800" data-id="${item.id}">×</button>
                    </div>
                </div>
            `;
                });

                cartTotal.textContent = `$${total.toFixed(2)}`;
            }

            // Remove item from cart
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-item')) {
                    const id = e.target.dataset.id;
                    const index = cart.findIndex(item => item.id === id);
                    if (index > -1) {
                        cart.splice(index, 1);
                        updateCart();
                    }
                }
            });

            // Checkout
            checkoutBtn.addEventListener('click', function() {
                if (cart.length > 0) {
                    // Redirect to success page
                    window.location.href = '{{ route('order.success') }}'; // Adjust route as needed
                } else {
                    showNotification('Your cart is empty!');
                }
            });

            // Show notification
            function showNotification(message) {
                notificationText.textContent = message;
                notification.classList.remove('hidden', 'translate-x-full');
                setTimeout(() => {
                    notification.classList.add('translate-x-full');
                    setTimeout(() => {
                        notification.classList.add('hidden');
                    }, 300);
                }, 3000);
            }

            // Search functionality
            searchInput.addEventListener('input', filterItems);

            // Category filter
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    categoryButtons.forEach(btn => btn.classList.remove('bg-blue-600',
                        'text-white'));
                    categoryButtons.forEach(btn => btn.classList.add('bg-gray-200',
                        'text-gray-700'));
                    this.classList.remove('bg-gray-200', 'text-gray-700');
                    this.classList.add('bg-blue-600', 'text-white');
                    filterItems();
                });
            });

            function filterItems() {
                const searchTerm = searchInput.value.toLowerCase();
                const activeCategory = document.querySelector('.category-btn.bg-blue-600').dataset.category;

                foodItems.forEach(item => {
                    const name = item.querySelector('h3').textContent.toLowerCase();
                    const category = item.dataset.category;
                    const matchesSearch = name.includes(searchTerm);
                    const matchesCategory = activeCategory === 'all' || category === activeCategory;

                    if (matchesSearch && matchesCategory) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
        });
    </script>
@endsection
