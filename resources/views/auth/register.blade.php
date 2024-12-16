<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | Spotify Clone</title>

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
            <h1 class="mt-4 text-2xl font-semibold">Sign up for Moodify</h1>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="block w-full mt-1 px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:ring-green-500 focus:border-green-500">
                @error('name')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="block w-full mt-1 px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:ring-green-500 focus:border-green-500">
                @error('email')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input id="password" type="password" name="password" required class="block w-full mt-1 px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:ring-green-500 focus:border-green-500">
                @error('password')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="block w-full mt-1 px-4 py-2 bg-gray-800 border border-gray-700 rounded-md text-white focus:ring-green-500 focus:border-green-500">
                @error('password_confirmation')<p class="mt-2 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm text-green-500 hover:underline">Already have an account?</a>
                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md">Sign up</button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-400">By signing up, you agree to Spotify's <a href="#" class="text-green-500 hover:underline">Terms and Conditions</a>.</p>
        </div>
    </div>
</body>
</html>
