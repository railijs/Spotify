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
                <!-- Playlist Table with White Border and Gradient Background -->
                <div class="overflow-hidden shadow-lg rounded-lg bg-gradient-to-r from-gray-800 via-gray-900 to-black border-2 border-white">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Mood</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Created At</th>
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
                {{ $playlist->created_at->format('Y-m-d H:i:s') }}
            </td>
        </tr>
        <tr>
            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                <strong>Songs:</strong>
                <ul>
                    @foreach($playlist->songs as $song)
                        <li>{{ $song->name }} by {{ $song->artist }}</li>
                    @endforeach
                </ul>
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

