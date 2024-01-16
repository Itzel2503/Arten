<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @livewireStyles
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .scrollEdit::-webkit-scrollbar {
            width: 6px;
            /* width of the entire scrollbar */
            border-radius: 20px;
        }

        .scrollEdit::-webkit-scrollbar-track {
            background: #ccc;
            /* color of the tracking area */
            border-radius: 20px;
        }

        .scrollEdit::-webkit-scrollbar-thumb {
            background-color: #324d57;
            /* color of the scroll thumb */
            border-radius: 20px;
            /* roundness of the scroll thumb */
            border: 2.5px solid #324d57;
            /* creates padding around scroll thumb */
        }

        .scrollEdit::-webkit-scrollbar-thumb:hover {
            background: #154854;
            box-shadow: 0 0 2px 1px rgb(0 0 0 / 20%);
            border: #ccc;
        }

        /* Style for the range slider */
        input[type="range"] {
            -webkit-appearance: none;
            width: 150px;
            height: 10px;
            border-radius: 5px;
            background: rgb(50 77 87);
            outline: none;
            opacity: 1;
            transition: opacity 0.2s;
        }
        /* Style for the slider thumb */
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgb(79 174 173);
            cursor: pointer;
        }
        input[type="range"]::-moz-range-thumb {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgb(79 174 173);
            cursor: pointer;
        }
    </style>

<body>
    <div id="mainMenu" class="flex flex-row items-center justify-center rounded-md p-5 bg-main-fund">
        <button id="screenshotButton" class="mx-5 w-12 h-12 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-main hover:text-secondary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
            </svg>              
        </button>
        <button id="startButton" class="mx-5 w-12 h-12 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-main hover:text-secondary">
                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>              
        </button>
        <button id="textButton" class="mx-5 w-12 h-12 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-main hover:text-secondary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>                       
        </button>
    </div>
    
    <div id="shotMenu" class="flex flex-row items-center justify-center rounded-md p-5 bg-main-fund" style="display: none;">
        <button id="returnButton" class="mx-5 w-12 h-12 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-main hover:text-secondary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>              
        </button>
        <button class="ml-5 w-10 h-10 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
            </svg>              
        </button>

        <input min="1" max="20" value="10" type="range" id="lineWidthSlider" class="mt-5 mx-5">
        
        <button id="downloadShot" class="mx-5 w-12 h-12 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-main hover:text-secondary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
            </svg>              
        </button>
    </div>

    <div id="videoMenu" class="flex flex-row items-center justify-center rounded-md p-5 bg-main-fund" style="display: none;">
        <button id="returnButtonVideo" class="mx-5 w-12 h-12 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-main hover:text-secondary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg> 
        </button>
        <button id="stopButton" class="mx-5 w-12 h-12 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-main hover:text-secondary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 9.563C9 9.252 9.252 9 9.563 9h4.874c.311 0 .563.252.563.563v4.874c0 .311-.252.563-.563.563H9.564A.562.562 0 0 1 9 14.437V9.564Z" />
            </svg>              
        </button>
    </div>

    <div id="textMenu" class="flex flex-row items-center justify-center rounded-md p-5 bg-main-fund" style="display: none;">
        <button id="returnButtonText" class="mx-5 w-12 h-12 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-main hover:text-secondary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg> 
        </button>
    </div>

    <div id="rightBar" class="fixed pb-20 top-0 right-0 h-full w-1/3 z-5 overflow-y-auto scrollEdit bg-main-fund" style="display: none;">
        <div class="px-4 pb-4 pt-10  h-full w-full">
            <div id="viewPhoto" style="display: none;">
                <h2 class="inline-flex font-semibold">
                    Imagen capturada
                </h2>
                <div id="renderedCanvas" class="w-full h-auto mt-8"></div>
                <div class="flex justify-center items-center py-6 bg-main-fund">
                    <button id="downloadButton" class="px-4 py-2 mt-5 font-semibold bg-secondary-fund hover:bg-secondary rounded cursor-pointer" style="color: white;">Guardar captura</button>
                </div>
            </div>
            
            <div id="viewVideo" style="display: none;">
                <h2 class="inline-flex font-semibold">
                    Video capturado
                </h2>
                <video id="recording" width="300" height="200" controls class="mt-8 w-full h-2/5"></video>
                <div class="flex justify-center items-center py-6 bg-main-fund">
                    <a id="downloadVideoButton" class="px-4 py-2 font-semibold bg-secondary-fund hover:bg-secondary rounded cursor-pointer" style="color: white;">Descargar video</a>
                </div>
            </div>
            
            <form id="formReport" action="{{route('reports.store')}}" method="POST">
            @csrf 
                <input hidden type="text" id="project_id" name="project_id" value="{{ $project_id }}">
                <input hidden type="text" id="user_id" name="user_id" value="{{ $user->id }}">
                <input hidden type="text" id="inputVideo" name="video">
                <input hidden type="text" id="inputPhoto" name="photo">

                <div id="viewText" class="-mx-3 md:flex mb-6" style="display: none;">
                    <div class="md:w-1/2 flex flex-col px-3 mb-6 md:mb-0">
                        <h5 class="inline-flex font-semibold" for="name">
                            Selecciona un archivo
                        </h5>
                        <input type="file" name="file" id="file" class="leading-snug border border-gray-400 block appearance-none bg-white text-gray-700 py-1 px-4 w-full rounded mx-auto">
                    </div>
                </div>

                <div class="-mx-3 md:flex mb-6 bg-main-fund">
                    <div class="md:w-1/2 flex flex-col px-3 mb-6 md:mb-0">
                        <h5 class="inline-flex font-semibold" for="name">
                            Tìtulo del reporte
                        </h5>
                        <input required type="text" name="title" id="title" class="leading-snug border border-gray-400 block appearance-none bg-white text-gray-700 py-1 px-4 w-full rounded mx-auto">
                    </div>
                    <div class="md:w-1/2 flex flex-col px-3">
                        <h5 class="inline-flex font-semibold" for="name">
                            Descripción del reporte
                        </h5>
                        <textarea required type="text" rows="10" placeholder="Describa la observación y especifique el objetivo a cumplir." name="comment" id="report" class="fields1 leading-snug border border-gray-400 block appearance-none bg-white text-gray-700 py-1 px-4 w-full rounded mx-auto"></textarea> 
                    </div>
                </div>

                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 flex flex-col px-3 mb-6 md:mb-0">
                        <h5 class="inline-flex font-semibold" for="name">
                            Delegar
                        </h5>
                        <select required name="delegate" id="delegate" class="leading-snug border border-gray-400 block appearance-none bg-white text-gray-700 py-1 px-4 w-full rounded mx-auto">
                            <option selected>Selecciona...</option>
                            @foreach ($allUsers as $allUser)
                                <option value="{{ $allUser->id }}">{{ $allUser->name }} {{ $allUser->lastname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-center items-center py-6 bg-main-fund">
                    <button type="submit" class="px-4 py-2 font-semibold bg-secondary-fund hover:bg-secondary rounded cursor-pointer" style="color: white;">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <div id="artboard" class="w-full">
        <h2 class="top-10 left-10 px-2 py-4 font-semibold text-3xl">Previsualización</h2>
        <div class="w-full flex justify-center items-center">
            <p id="log" class="text-xl font-semibold text-red"></p>
        </div>

        <div id="capturedImageContainer" class="flex items-center justify-center"></div>
        <div id="renderCombinedImage"></div>
    
        <video id="preview" width="100%" height="auto" autoplay muted class="mt-2"></video>
    </div>

    {{-- CORDER --}}
    <script>
        let preview = document.getElementById("preview");
        let recording = document.getElementById("recording");
        let startButton = document.getElementById("startButton");
        let stopButton = document.getElementById("stopButton");
        let downloadVideoButton = document.getElementById("downloadVideoButton");
        let logElement = document.getElementById("log");
        let inputVideo = document.getElementById("inputVideo");
        let projectId = document.getElementById("project_id");
        let userId = document.getElementById("user_id");

        let dateNow = new Date();
        let year = dateNow.getFullYear();
        let month = ('0' + (dateNow.getMonth() + 1)).slice(-2);
        let day = ('0' + dateNow.getDate()).slice(-2);
        let hours = ('0' + dateNow.getHours()).slice(-2);
        let minutes = ('0' + dateNow.getMinutes()).slice(-2);
        let seconds = ('0' + dateNow.getSeconds()).slice(-2);

        let idProject = @json($project_id);
        let user = @json($user);

        let dateHour = year + '-' + month + '-' + day + ' ' + hours + '_' + minutes + '_' + seconds;
        
        function log(msg) {
            logElement.innerHTML = msg;
        }

        function startRecording(stream, lengthInMS) {
            let recorder = new MediaRecorder(stream);
            let data = [];
        
            recorder.ondataavailable = event => data.push(event.data);
            
            let stopped = new Promise((resolve, reject) => {
                recorder.onstop = resolve;
                recorder.onerror = event => reject(event.name);
            });

            recorder.start();
            log("Grabación iniciada.");

            return stopped.then(() => data);
        }

        function stop(stream) {
            stream.getTracks().forEach(track => track.stop());
        }

        startButton.addEventListener("click", function() {
            navigator.mediaDevices.getDisplayMedia({
                video: { mediaSource: 'screen' },
                audio: true
            }).then(stream => {
                preview.srcObject = stream;
                downloadVideoButton.href = stream;
                inputVideo.value = 'Reporte ' + dateHour +'.mp4';
                projectId.value = idProject;
                userId.value = user.id;
                preview.captureStream = preview.captureStream || preview.mozCaptureStream;
                return new Promise(resolve => preview.onplaying = resolve);
            }).then(() => startRecording(preview.captureStream()))
            .then (recordedChunks => {
                let recordedBlob = new Blob(recordedChunks, { type: "video/mp4" });
                recording.src = URL.createObjectURL(recordedBlob);
                downloadVideoButton.href = recording.src;
                downloadVideoButton.download = 'Reporte ' + dateHour +'.mp4';
            })
            /* .catch(log); */
        }, false);

        stopButton.addEventListener("click", function() {
            stop(preview.srcObject);
            log("Grabación finalizada.");
        }, false);

        //returnButton from Video
        document.getElementById('returnButtonVideo').addEventListener('click', function() {
            // Detener el video
            let preview = document.getElementById("preview");
            let recorder;
            preview.pause();
            preview.srcObject = null;

            if (recorder) {
                recorder.stop();
            }
            log('');
            recording.src = '';
            downloadVideoButton.href = '';
            inputVideo.value = '';

            // Mostrar el div principal y ocultar otros elementos
            document.getElementById('rightBar').style.display = 'none';
            document.getElementById('viewPhoto').style.display = 'none';
            document.getElementById('viewVideo').style.display = 'none';
            document.getElementById('mainMenu').style.display = 'flex';
            document.getElementById('videoMenu').style.display = 'none';

            cleanForm();
        });
    </script>

    {{-- SCREEN --}}
    <script>
        // Function to handle drawing on the overlay canvas
        const drawOnCanvas = (prevX, prevY, x, y, lineWidthValue, ctx) => {
            ctx.beginPath();
            ctx.moveTo(prevX, prevY);
            ctx.lineTo(x, y);
            ctx.lineCap = 'round'; // Make lines rounded
            ctx.strokeStyle = 'rgb(221 66 49)'; // Set the color for drawing (change as needed)
            ctx.lineWidth = lineWidthValue; // Set the line width from the slider
            ctx.stroke();
        };

        document.addEventListener('DOMContentLoaded', () => {
            const screenshotButton = document.getElementById('screenshotButton');
            const lineWidthSlider = document.getElementById('lineWidthSlider');
            const capturedImageContainer = document.getElementById('capturedImageContainer'); // Container to display captured image
            
            let inputPhoto = document.getElementById("inputPhoto");
            let projectId = document.getElementById("project_id");
            let userId = document.getElementById("user_id");

            let idProject = @json($project_id);
            let user = @json($user);

            let dateNow = new Date();
            let year = dateNow.getFullYear();
            let month = ('0' + (dateNow.getMonth() + 1)).slice(-2);
            let day = ('0' + dateNow.getDate()).slice(-2);
            let hours = ('0' + dateNow.getHours()).slice(-2);
            let minutes = ('0' + dateNow.getMinutes()).slice(-2);
            let seconds = ('0' + dateNow.getSeconds()).slice(-2);

            let dateHour = year + '-' + month + '-' + day + ' ' + hours + '_' + minutes + '_' + seconds;

            screenshotButton.addEventListener('click', () => {
                navigator.mediaDevices.getDisplayMedia({
                    video: true,
                    audio: false // We don't need audio for screenshots
                }).then(stream => {
                    const videoTrack = stream.getVideoTracks()[0];
                    const imageCapture = new ImageCapture(videoTrack);

                    imageCapture.grabFrame().then(imageBitmap => {
                        const canvas = document.createElement('canvas');
                        canvas.width = imageBitmap.width;
                        canvas.height = imageBitmap.height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(imageBitmap, 0, 0);

                        // Create an image element and set the source to the captured image
                        const capturedImage = new Image();
                        capturedImage.src = canvas.toDataURL('image/jpg');

                        capturedImage.onload = () => {
                            capturedImageContainer.innerHTML = ''; // Clear previous content
                            capturedImageContainer.appendChild(capturedImage);

                            // Retrieve the dimensions and position of the captured image
                            const imageRect = capturedImage.getBoundingClientRect();

                            // Create a drawing canvas for overlay
                            const drawCanvas = document.createElement('canvas');
                            drawCanvas.width = imageRect.width; // Use the width of the captured image
                            drawCanvas.height = imageRect.height; // Use the height of the captured image
                            drawCanvas.style.position = 'absolute';
                            drawCanvas.style.top = `${imageRect.top}px`; // Position the canvas at the same top position as the image
                            drawCanvas.style.left = `${imageRect.left}px`; // Position the canvas at the same left position as the image

                            // Append the drawing canvas to the document
                            document.body.appendChild(drawCanvas);

                            // Function to get the canvas context for drawing
                            const getDrawContext = () => drawCanvas.getContext('2d');

                            // Event listener for the line width slider
                            lineWidthSlider.addEventListener('input', function () {
                                const lineWidthValue = parseInt(this.value);
                                // Update line width on drawing canvas
                                const drawCtx = drawCanvas.getContext('2d');
                                drawCtx.lineWidth = lineWidthValue;
                            });

                            // Variables to store previous coordinates
                            let prevX, prevY;

                            // Event listeners to handle drawing on mouse interactions
                            let isDrawing = false;
                            drawCanvas.addEventListener('mousedown', e => {
                                isDrawing = true;
                                const rect = drawCanvas.getBoundingClientRect();
                                prevX = e.clientX - rect.left;
                                prevY = e.clientY - rect.top;
                            });

                            drawCanvas.addEventListener('mousemove', e => {
                                if (isDrawing) {
                                const rect = drawCanvas.getBoundingClientRect();
                                const x = e.clientX - rect.left;
                                const y = e.clientY - rect.top;
                                const drawCtx = getDrawContext();
                                drawOnCanvas(prevX, prevY, x, y, parseInt(lineWidthSlider.value), drawCtx);
                                prevX = x;
                                prevY = y;
                                }
                            });

                            drawCanvas.addEventListener('mouseup', () => {
                                isDrawing = false;
                            });

                            drawCanvas.addEventListener('mouseleave', () => {
                                isDrawing = false;
                            });


                            // Function to render the combined image for preview
                            const renderCombinedImage = (combinedDataURL) => {
                                const renderedCanvas = document.getElementById('renderedCanvas');
                                renderedCanvas.innerHTML = ''; // Clear previous content
                                const renderedImage = new Image();
                                renderedImage.src = combinedDataURL;
                                inputPhoto.value = 'Reporte ' + dateHour +'.jpg';
                                projectId.value = idProject;
                                userId.value = user.id;
                                renderedCanvas.appendChild(renderedImage);
                            };

                            // button with the id "downloadShot"
                            const downloadShotButton = document.getElementById('downloadShot');

                            // Add click event listener to the downloadShot button
                            downloadShotButton.addEventListener('click', () => {
                                const combinedCanvas = document.createElement('canvas');
                                combinedCanvas.width = imageBitmap.width;
                                combinedCanvas.height = imageBitmap.height;
                                const combinedCtx = combinedCanvas.getContext('2d');

                                // Draw the screen capture onto the combined canvas
                                combinedCtx.drawImage(imageBitmap, 0, 0);

                                // Create a new image element for the drawing canvas
                                const drawImage = new Image();
                                drawImage.src = drawCanvas.toDataURL('image/jpg');

                                // When the drawing canvas image is fully loaded, render it onto the combined canvas
                                drawImage.onload = () => {
                                    combinedCtx.drawImage(drawImage, 0, 0);

                                    // Get the combined canvas data URL and render the image for preview
                                    const combinedDataURL = combinedCanvas.toDataURL('image/jpg');
                                    renderCombinedImage(combinedDataURL);
                                };
                            });

                            // Function to handle the download
                            const downloadImage = () => {
                                const combinedCanvas = document.createElement('canvas');
                                combinedCanvas.width = imageBitmap.width;
                                combinedCanvas.height = imageBitmap.height;
                                const combinedCtx = combinedCanvas.getContext('2d');

                                // Draw the screen capture onto the combined canvas
                                combinedCtx.drawImage(imageBitmap, 0, 0);

                                // Create a new image element for the drawing canvas
                                const drawImage = new Image();
                                drawImage.src = drawCanvas.toDataURL('image/jpg');

                                // When the drawing canvas image is fully loaded, render it onto the combined canvas
                                drawImage.onload = () => {
                                    combinedCtx.drawImage(drawImage, 0, 0);

                                    // Get the combined canvas data URL and create a download link
                                    const combinedDataURL = combinedCanvas.toDataURL('image/jpg');
                                    const a = document.createElement('a');
                                    a.href = combinedDataURL;
                                    a.download = 'Reporte ' + dateHour +'.jpg';
                                    a.click();
                                };
                            };    
                            // button with the id "downloadButton"
                            const downloadButton = document.getElementById('downloadButton');
                            // Add click event listener to the download button
                            downloadButton.addEventListener('click', downloadImage);
                        };
                    }).catch(error => {
                        console.error('Error grabbing frame:', error);
                    });
                }).catch(error => {
                console.error('Error accessing media devices:', error);
                });
            });
        });
    </script>

    {{-- BUTTONS --}}
    <script>
        //screenshotButton
        document.getElementById('screenshotButton').addEventListener('click', function() {
            document.getElementById('mainMenu').style.display = 'none';
            document.getElementById('shotMenu').style.display = 'flex';
        });
        //returnButton from screen Shot
        document.getElementById('returnButton').addEventListener('click', function() {
            // Reiniciar el div donde se muestra la captura de pantalla
            const capturedImageContainer = document.getElementById('capturedImageContainer');
            capturedImageContainer.innerHTML = '';

            // Eliminar el dibujo realizado en el overlay canvas
            const drawCanvas = document.querySelector('canvas');
            if (drawCanvas) {
                drawCanvas.parentNode.removeChild(drawCanvas);
            }

            document.getElementById("inputPhoto").value = '';

            // Reiniciar el div donde se muestra la vista previa de la imagen combinada
            const renderedCanvas = document.getElementById('renderedCanvas');
            renderedCanvas.innerHTML = '';

            // Mostrar el div principal y ocultar otros elementos
            document.getElementById('rightBar').style.display = 'none';
            document.getElementById('viewPhoto').style.display = 'none';
            document.getElementById('viewVideo').style.display = 'none';
            document.getElementById('mainMenu').style.display = 'flex';
            document.getElementById('shotMenu').style.display = 'none';
            cleanForm();
        });
        //start recording video button
        document.getElementById('startButton').addEventListener('click', function() {
            document.getElementById('mainMenu').style.display = 'none';
            document.getElementById('videoMenu').style.display = 'flex';
        });
        //text button
        document.getElementById('textButton').addEventListener('click', function() {
            let idProject = @json($project_id);
            let user = @json($user);

            document.getElementById('rightBar').style.display = 'flex';
            document.getElementById('textMenu').style.display = 'flex';
            document.getElementById('mainMenu').style.display = 'none';
            document.getElementById('viewText').style.display = 'block';

            document.getElementById("project_id").value = idProject;
            document.getElementById("user_id").value = user.id;;
        });
        //returnButtonText from text
        document.getElementById('returnButtonText').addEventListener('click', function() {
            document.getElementById('rightBar').style.display = 'none';
            document.getElementById('viewPhoto').style.display = 'none';
            document.getElementById('viewVideo').style.display = 'none';
            document.getElementById('mainMenu').style.display = 'flex';
            document.getElementById('textMenu').style.display = 'none';
            document.getElementById('viewText').style.display = 'none';
            cleanForm();
        });
        //stop recording button
        document.getElementById('stopButton').addEventListener('click', function() {
            document.getElementById('rightBar').style.display = 'flex';
            document.getElementById('viewVideo').style.display = 'block';
        });
        //Save combined screenshot-canvas button
        document.getElementById('downloadShot').addEventListener('click', function() {
            document.getElementById('rightBar').style.display = 'flex';
            document.getElementById('viewPhoto').style.display = 'block';
        });

        function cleanForm() {
            const formulario = document.getElementById('formReport'); 
            const elementosFormulario = formulario.querySelectorAll('input, textarea');

            // Establece los valores de los elementos en vacío
            elementosFormulario.forEach(elemento => {
                if (elemento.type !== 'button' && elemento.type !== 'submit') {
                    elemento.value = '';
                }
            });
        }
    </script>
</body>
</html>