<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard-RMS</title>
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
  <div class="min-h-screen flex">
    @include('admin.sidebar')
    <div class="flex-1 flex flex-col">
      @include('admin.header')
      <main class="flex-1 px-4 sm:px-6 lg:px-8 pb-10">
        @include('admin.body')
      </main>
    </div>
  </div>
</body>
</html>