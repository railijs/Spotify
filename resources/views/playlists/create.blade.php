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
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
<script src="https://cdn.jsdelivr.net/npm/face-api.js"></script>


    <!-- Your custom script -->
<!-- Ensure TensorFlow.js and face-api.js are loaded first -->
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
<script src="https://cdn.jsdelivr.net/npm/face-api.js"></script>

<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('overlay');
    const displaySize = { width: video.width, height: video.height };

    async function loadModels() {
        console.log('Loading models...');
        try {
            await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
            await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
            await faceapi.nets.faceExpressionNet.loadFromUri('/models');
            console.log('Models loaded successfully.');
        } catch (error) {
            console.error('Error loading models:', error);
        }
    }

    async function startVideo() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
            video.srcObject = stream;
            console.log('Video started successfully.');
        } catch (error) {
            console.error('Error accessing webcam:', error);
        }
    }

    async function detectFaces() {
        if (!video || video.paused || video.ended) {
            console.warn('Video not ready for detection.');
            return;
        }

        try {
            const detections = await faceapi.detectAllFaces(video, 
                new faceapi.TinyFaceDetectorOptions())
                .withFaceLandmarks()
                .withFaceExpressions();

            const resizedDetections = faceapi.resizeResults(detections, displaySize);

            const ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            faceapi.draw.drawDetections(canvas, resizedDetections);
            faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
            faceapi.draw.drawFaceExpressions(canvas, resizedDetections);

            requestAnimationFrame(detectFaces);
        } catch (error) {
            console.error('Error detecting faces:', error);
        }
    }

    async function init() {
        console.log('Initializing...');
        await loadModels();
        await startVideo();
        faceapi.matchDimensions(canvas, displaySize);
        detectFaces();
    }

    document.addEventListener('DOMContentLoaded', init);
</script>

</x-app-layout>
