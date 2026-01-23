<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Restaurant management that feels premium and modern.">
    <title>Restaurant Manager</title>

    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Tailwind CDN preset for quick theming -->
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
                        sans: ['Inter', 'DM Sans', 'system-ui', 'sans-serif'],
                        display: ['Playfair Display', 'DM Sans', 'serif']
                    }
                }
            }
        }
    </script>
</head>
<body id="home" class="bg-base text-white">
    @include('home.navbar')

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        @include('home.header')

        <section id="about" class="py-16 md:py-20">
            @include('home.about')
        </section>

        <section id="blog" class="py-16 md:py-20">
            @include('home.blog')
        </section>

        <section id="gallary" class="py-16 md:py-20">
            @include('home.gallary')
        </section>

        <section id="contact" class="py-16 md:py-20">
            @include('home.contact')
        </section>
    </main>

    @include('home.footer')

    <!-- Map -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtme10pzgKSPeJVJrG1O3tjR6lk98o4w8&callback=initMap"></script>
</body>
</html>
