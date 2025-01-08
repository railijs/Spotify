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

    requestAnimationFrame(detectFaces); // Call detectFaces again for continuous detection
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
