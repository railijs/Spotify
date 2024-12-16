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
            <h1 class="mt-4 text-2xl font-semibold">Log in to Moodify</h1>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="block w-full mt-1 px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:ring-green-500 focus:border-green-500">
                @error('email')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input id="password" type="password" name="password" required class="block w-full mt-1 px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:ring-green-500 focus:border-green-500">
                @error('password')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-green-500 bg-gray-800 border-gray-700 rounded focus:ring-green-400">
                <label for="remember_me" class="ml-2 text-sm text-gray-300">Remember me</label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-green-500 hover:underline">Forgot your password?</a>
                @endif

                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md">Log in</button>
            </div>
        </form>

        <div class="mt-6 text-center">
            @if (Route::has('register'))
                <p class="text-sm text-gray-400">Don't have an account? <a href="{{ route('register') }}" class="text-green-500 hover:underline">Sign up</a></p>
            @endif
        </div>
    </div>
</body>
</html>