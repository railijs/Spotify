<x-app-layout>
    <!-- Full-page Gradient Background -->
    <div class="min-h-screen bg-gradient-to-r from-gray-800 via-gray-900 to-black">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <!-- Playlist History Header with Gradient and White Text -->
            <h1 class="text-4xl font-bold text-white mb-6">
                Playlist History
            </h1>

            <!-- Empty Playlist Message -->
            @if($playlists->isEmpty())
                <p class="text-white text-lg">No playlists created yet.</p>
            @else
                <!-- Playlist Table with Improved Styling -->
                <div class="overflow-hidden shadow-lg rounded-lg bg-gradient-to-r from-gray-800 via-gray-900 to-black border border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Playlist Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Mood</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Spotify Link</th> <!-- Updated header -->
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Mood Selected At</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-900 divide-y divide-gray-700">
                            @foreach($playlists as $playlist)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                        {{ $playlist->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                        {{ $playlist->mood }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                        {{ $playlist->description }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                        <a href="{{ $playlist->spotify_playlist_link }}" target="_blank" class="text-blue-400 underline">{{ $playlist->spotify_playlist_link }}</a> <!-- Spotify link -->
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                                        {{ $playlist->updated_at->format('Y-m-d H:i:s') }} <!-- Assuming updated_at stores mood selection time -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
