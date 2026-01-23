<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center"
      style="background-image: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb');">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-8">

        <!-- Header -->
        <div class="text-center mb-6">
            <div class="text-yellow-600 text-5xl mb-3">
                <i class="fas fa-hotel"></i>
            </div>
            <h2 class="text-2xl font-bold">Hotel Management</h2>
            <p class="text-gray-500 text-sm">Login to manage your hotel</p>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Google Login -->
        <a href="{{ route('google.login') }}"
           class="flex items-center justify-center gap-3 border border-gray-300 rounded-lg py-2 font-semibold text-gray-700 hover:bg-gray-100 transition mb-5">
            <img src="https://developers.google.com/identity/images/g-logo.png"
                 alt="Google"
                 class="w-5 h-5">
            Continue with Google
        </a>

        <!-- Divider -->
        <div class="flex items-center my-5">
            <div class="flex-grow h-px bg-gray-300"></div>
            <span class="px-3 text-sm text-gray-500">OR</span>
            <div class="flex-grow h-px bg-gray-300"></div>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <div class="flex items-center border rounded-lg px-3">
                    <i class="fa fa-envelope text-gray-400"></i>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="w-full p-2 outline-none text-sm">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <div class="flex items-center border rounded-lg px-3">
                    <i class="fa fa-lock text-gray-400"></i>
                    <input type="password"
                           name="password"
                           required
                           class="w-full p-2 outline-none text-sm">
                </div>
            </div>

            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="rounded">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-yellow-600 hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <button type="submit"
                    class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 rounded-lg transition">
                Login
            </button>
        </form>

    </div>

</body>
</html>
