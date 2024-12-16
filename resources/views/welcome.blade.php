<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Spotify Clone</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="flex items-center justify-center min-h-screen bg-black text-white font-sans">
    <div class="w-full max-w-md p-6 bg-gray-900 rounded-lg shadow-lg">
        <div class="text-center mb-8">
           
            <h1 class="mt-4 text-2xl font-semibold">Welcome to Moodify</h1>
        </div>

        <div class="space-y-6">
            @if (Route::has('login'))
                <div class="flex flex-col gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block w-full py-2 px-4 text-center bg-green-500 hover:bg-green-600 rounded-md font-medium transition">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full py-2 px-4 text-center bg-green-500 hover:bg-green-600 rounded-md font-medium transition">
                            Log In
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block w-full py-2 px-4 text-center bg-gray-700 hover:bg-gray-600 rounded-md font-medium transition">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <footer class="mt-8 text-center text-sm text-gray-400">
            Find new songs according to your mood!
        </footer>
    </div>
</body>
</html>