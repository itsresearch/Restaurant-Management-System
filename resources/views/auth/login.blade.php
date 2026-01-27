<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Restaurant Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        base: '#0c0f14',
                        panel: '#111621',
                        card: '#151b27',
                        accent: '#f59e0b',
                        accent2: '#fb7185',
                        muted: '#9aa4b5'
                    },
                    fontFamily: {
                        sans: ['DM Sans', 'Inter', 'system-ui', 'sans-serif'],
                        display: ['Playfair Display', 'serif']
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen bg-base flex items-center justify-center px-4 text-white font-sans antialiased">

    <div class="w-full max-w-md bg-card/95 backdrop-blur-sm rounded-2xl shadow-2xl shadow-black/40 p-8 border border-white/10">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex w-14 h-14 rounded-2xl bg-gradient-to-br from-accent2/20 to-accent/20 items-center justify-center mb-4">
                <i class="fas fa-utensils text-accent text-2xl"></i>
            </div>
            <h1 class="text-2xl font-display font-bold">Restaurant Manager</h1>
            <p class="text-muted text-sm mt-1">Sign in to your account</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-3 rounded-xl text-sm mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <a href="{{ route('google.login') }}"
           class="flex items-center justify-center gap-3 w-full border border-white/10 rounded-xl py-3 font-medium text-white hover:bg-white/5 transition mb-6">
            <img src="https://developers.google.com/identity/images/g-logo.png" class="w-5 h-5" alt="Google">
            Continue with Google
        </a>

        <div class="flex items-center my-6">
            <div class="flex-grow h-px bg-white/10"></div>
            <span class="px-3 text-xs text-muted uppercase tracking-widest">or</span>
            <div class="flex-grow h-px bg-white/10"></div>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            @php
                $inputClass = "w-full bg-panel border border-white/10 rounded-xl px-4 py-3 text-white placeholder-white/40 outline-none focus:border-accent focus:ring-2 focus:ring-accent/20 transition text-sm";
            @endphp

            <div>
                <label class="block text-sm font-medium text-white/90 mb-1.5">Email</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40"><i class="fa fa-envelope text-sm"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="{{ $inputClass }} pl-10" placeholder="you@example.com">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-white/90 mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40"><i class="fa fa-lock text-sm"></i></span>
                    <input type="password" name="password" required
                           class="{{ $inputClass }} pl-10" placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 cursor-pointer text-white/80">
                    <input type="checkbox" name="remember" class="rounded border-white/20 bg-panel text-accent focus:ring-accent/30">
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-accent hover:underline font-medium">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit"
                    class="w-full py-3.5 rounded-xl bg-gradient-to-r from-accent2 to-accent text-base font-bold text-white shadow-lg shadow-accent/20 hover:shadow-accent/30 transition">
                Sign in
            </button>
        </form>

        <p class="text-center text-sm text-muted mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-accent font-semibold hover:underline">Create account</a>
        </p>
    </div>

</body>
</html>
