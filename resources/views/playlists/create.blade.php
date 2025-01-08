<x-app-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-r from-gray-800 via-gray-900 to-black py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-gray-800 p-8 rounded-lg shadow-md">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white">Detect Your Mood</h2>
                <p class="mt-2 text-sm text-gray-300">Your webcam will be used to detect your mood.</p>
            </div>

            <!-- Video and Canvas for Webcam -->
            <video id="video" width="720" height="560" autoplay muted></video>
            <canvas id="overlay" width="720" height="560"></canvas>

            <!-- Mood-Based Playlist Display -->
            <div id="playlistDisplay" class="hidden mt-4">
                <h3 class="text-lg font-medium text-white">Recommended Playlist:</h3>
                <p id="playlistLink" class="mt-2 text-sm text-gray-300"></p>
                <img id="playlistImage" src="" alt="" class="mt-2 rounded-lg hidden" />
            </div>
        </div>
    </div>

    <!-- Load TensorFlow.js and face-api.js from CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/face-api.js"></script>

    <!-- Your custom script -->
    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('overlay');
        const displaySize = { width: video.width, height: video.height };

        async function loadModels() {
            await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
            await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
            await faceapi.nets.faceExpressionNet.loadFromUri('/models');
        }

        async function startVideo() {
            const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
            video.srcObject = stream;
        }

        async function detectFaces() {
            const detections = await faceapi.detectAllFaces(video,
                new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceExpressions();

            const resizedDetections = faceapi.resizeResults(detections, displaySize);
            
            // Clear previous results
            canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
            
            // Draw detections on canvas
            faceapi.draw.drawDetections(canvas, resizedDetections);
            faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
            faceapi.draw.drawFaceExpressions(canvas, resizedDetections);

            if (resizedDetections.length > 0) {
                const expressions = resizedDetections[0].expressions;
                const mood = getDominantMood(expressions);
                fetchPlaylists(mood); // Fetch playlists based on detected mood
            }

            requestAnimationFrame(detectFaces); // Call detectFaces again for continuous detection
        }

        function getDominantMood(expressions) {
            let dominantMood = 'neutral'; // Default mood
            const threshold = 0.5; // Set threshold for mood detection

            if (expressions.happy > threshold) {
                dominantMood = 'happy';
            } else if (expressions.sad > threshold) {
                dominantMood = 'sad';
            } else if (expressions.angry > threshold) {
                dominantMood = 'angry';
            } else if (expressions.surprised > threshold) {
                dominantMood = 'surprised';
            }

            return dominantMood;
        }

        async function fetchPlaylists(mood) {
            const response = await fetch(`/api/playlists?mood=${mood}`);
            
            if (response.ok) {
                const playlists = await response.json();
                displayPlaylists(playlists); // Function to display playlists in UI
            } else {
                console.error('Failed to fetch playlists');
            }
        }

        function displayPlaylists(playlists) {
            const playlistLink = document.getElementById('playlistLink');
            const playlistImage = document.getElementById('playlistImage');

            if (playlists.length > 0) {
                const firstPlaylist = playlists[0]; // Get the first playlist
                playlistLink.innerHTML = `<a href="${firstPlaylist.spotify_playlist_link}" target="_blank" class="text-blue-400 underline">${firstPlaylist.name}</a>`;
                playlistImage.src = firstPlaylist.image_url; // Assuming you have an image_url field
                playlistImage.classList.remove('hidden'); // Show the image
                document.getElementById('playlistDisplay').classList.remove('hidden'); // Show the playlist display
            } else {
                playlistLink.innerHTML = '';
                playlistImage.classList.add('hidden'); // Hide the image if no playlists found
                document.getElementById('playlistDisplay').classList.add('hidden'); // Hide the playlist display
            }
        }

        async function init() {
            await loadModels();
            startVideo();
            
            // Set canvas size to match video size
            faceapi.matchDimensions(canvas, displaySize);
            
            // Start detecting faces
            detectFaces();
        }

        init();
    </script>
</x-app-layout>
