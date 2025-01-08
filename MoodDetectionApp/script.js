const video = document.getElementById('video');
const canvas = document.getElementById('overlay');
const displaySize = { width: video.width, height: video.height };

// Load face-api models
async function loadModels() {
    await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
    await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
    await faceapi.nets.faceRecognitionNet.loadFromUri('/models');
    await faceapi.nets.faceExpressionNet.loadFromUri('/models');
}

// Start video stream
async function startVideo() {
    const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
    video.srcObject = stream;
}

// Detect faces and emotions
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

    requestAnimationFrame(detectFaces); // Call detectFaces again for continuous detection
}

// Initialize everything
async function init() {
    await loadModels();
    startVideo();
    
    // Set canvas size to match video size
    faceapi.matchDimensions(canvas, displaySize);
    
    // Start detecting faces
    detectFaces();
}

init();
