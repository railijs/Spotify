<x-app-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-r from-gray-800 via-gray-900 to-black py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-gray-800 p-8 rounded-lg shadow-md">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white">Select Your Mood</h2>
                <p class="mt-2 text-sm text-gray-300">Choose a mood to get a recommended playlist.</p>
            </div>
            <form id="moodForm" class="mt-8 space-y-6" action="#" method="POST">
                @csrf

                <!-- Mood Selection -->
                <div>
                    <label for="mood" class="block text-sm font-medium text-gray-300">Mood</label>
                    <select id="mood" name="mood" required onchange="showPlaylist()"
                        class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-700 bg-gray-700 text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select a mood</option>
                        <option value="happy">Happy</option>
                        <option value="sad">Sad</option>
                        <option value="energetic">Energetic</option>
                        <option value="relaxed">Relaxed</option>
                    </select>
                </div>

                <!-- Mood-Based Playlist Display -->
                <div id="playlistDisplay" class="hidden mt-4">
                    <h3 class="text-lg font-medium text-white">Recommended Playlist:</h3>
                    <p id="playlistLink" class="mt-2 text-sm text-gray-300"></p>
                    <img id="playlistImage" src="" alt="" class="mt-2 rounded-lg hidden" />
                </div>

            </form>
        </div>
    </div>

    <!-- JavaScript to handle mood selection -->
    <script>
        function showPlaylist() {
            const mood = document.getElementById('mood').value;
            const playlistDisplay = document.getElementById('playlistDisplay');
            const playlistLink = document.getElementById('playlistLink');
            const playlistImage = document.getElementById('playlistImage');

            // Define playlists and images based on moods
            const playlists = {
                happy: {
                    link: 'https://open.spotify.com/playlist/0RH319xCjeU8VyTSqCF6M4',
                    image: 'https://rachelziv.com.au/wp-content/uploads/2020/01/happy.jpg' // Happy playlist image
                },
                sad: {
                    link: 'https://open.spotify.com/playlist/sad_playlist_id',
                    image: 'https://example.com/sad_playlist_image.jpg' // Replace with actual image URL
                },
                energetic: {
                    link: 'https://open.spotify.com/playlist/energetic_playlist_id',
                    image: 'https://example.com/energetic_playlist_image.jpg' // Replace with actual image URL
                },
                relaxed: {
                    link: 'https://open.spotify.com/playlist/relaxed_playlist_id',
                    image: 'https://example.com/relaxed_playlist_image.jpg' // Replace with actual image URL
                },
            };

            if (playlists[mood]) {
                playlistLink.innerHTML = `<a href="#" onclick="savePlaylist('${mood}', '${playlists[mood].link}'); return false;" class="text-blue-400 underline">${playlists[mood].link}</a>`;
                playlistImage.src = playlists[mood].image;
                playlistImage.alt = `${mood.charAt(0).toUpperCase() + mood.slice(1)} Playlist Cover`;
                playlistImage.classList.remove('hidden'); // Show the image
                playlistDisplay.classList.remove('hidden');
            } else {
                playlistDisplay.classList.add('hidden');
                playlistImage.classList.add('hidden'); // Hide the image if no mood is selected
            }
        }

        function savePlaylist(mood, link) {
            // Send AJAX request to save the playlist
            fetch('{{ route("playlists.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    mood: mood,
                    name: `Playlist for ${mood}`, // You can customize this as needed
                    description: `A ${mood} themed playlist.`,
                    spotify_playlist_link: link,
                })
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = '{{ route("playlists.history") }}'; // Redirect to history page
                } else {
                    console.error('Failed to save the playlist.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

</x-app-layout>
