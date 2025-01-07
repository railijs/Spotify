<x-app-layout>
    <!-- Main content of the dashboard -->
    <div class="min-h-screen bg-gradient-to-r from-gray-800 via-gray-900 to-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <button class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition duration-200">Add Content</button>
                    </div>
                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Card 1 -->
                        <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                            <h4 class="text-xl text-white">Feature 1</h4>
                            <p class="text-gray-400">Description of feature 1 goes here.</p>
                        </div>

                        <!-- Card 2 -->
                        <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                            <h4 class="text-xl text-white">Feature 2</h4>
                            <p class="text-gray-400">Description of feature 2 goes here.</p>
                        </div>

                        <!-- Card 3 -->
                        <div class="bg-gray-700 p-6 rounded-lg shadow-md">
                            <h4 class="text-xl text-white">Feature 3</h4>
                            <p class="text-gray-400">Description of feature 3 goes here.</p>
                        </div>
                    </div>

                    <!-- Section for Webcam and Face Detection -->
                    <div class="mt-6">
                        <h4 class="text-xl text-white mb-4">Sigma Detection</h4>
                        <div class="relative">
                            <video id="video" autoplay muted class="w-full h-96 object-cover rounded-lg"></video>
                            <canvas id="overlay" class="absolute top-0 left-0 w-full h-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Face API.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/face-api.js"></script>

    <!-- Webcam and Face Detection Script -->
    <script>
        // Load Face API models
        async function loadModels() {
            await faceapi.nets.ssdMobilenetv1.loadFromUri('/models');
            await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
            await faceapi.nets.faceRecognitionNet.loadFromUri('/models');
            startVideo();
        }

        // Start the video stream from webcam
        function startVideo() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('overlay');
            const displaySize = { width: video.width, height: video.height };

            // Set up webcam video stream
            navigator.mediaDevices.getUserMedia({
                video: { width: 640, height: 480 }
            }).then((stream) => {
                video.srcObject = stream;

                // Once the video is loaded, start face detection
                video.onloadeddata = () => {
                    faceapi.matchDimensions(canvas, displaySize);

                    // Detect faces every frame
                    setInterval(async () => {
                        const detections = await faceapi.detectAllFaces(video)
                            .withFaceLandmarks()
                            .withFaceDescriptors();
                        
                        const resizedDetections = faceapi.resizeResults(detections, displaySize);
                        canvas?.clear();
                        faceapi.draw.drawDetections(canvas, resizedDetections);
                        faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
                    }, 100);
                };
            });
        }

        // Load the models and start the process
        loadModels();
    </script>

    <!-- Styles for the video and canvas -->
    <style>
        #video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
    </style>
</x-app-layout>
