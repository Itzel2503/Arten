<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
            background: rgb(221 66 49);
            cursor: pointer;
        }
        input[type="range"]::-moz-range-thumb {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgb(221 66 49);
            cursor: pointer;
        }
    </style>

<body>
    <div id="mainMenu" class="flex flex-row items-center justify-center rounded-md p-5 bg-main-fund">
        <a href="{{ route('projects.reports.index', ['project' => $project->id]) }}" class="mx-5 w-auto h-12 flex justify-center items-center text-xl">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mr-2 text-main hover:text-secondary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>     
            Regresar            
        </a>
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
    </div>
    
    <div id="shotMenu" class="flex flex-row items-center justify-center rounded-md p-5 bg-main-fund" style="display: none;">
        <button id="returnButton" class="mx-5 w-12 h-12 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-main hover:text-secondary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>              
        </button>
        {{-- <button class="ml-5 w-10 h-10 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
            </svg>              
        </button> --}}

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

    <div id="rightBar" class="w-full" style="display: block;">
        <div class="w-full my-10 text-center">
            <label class=" text-secondary-fund">
                Reescribe o detalla más la descripción del reporte.<br>
                Delega el reporte a otro miembro del equipo si es necesario.<br>
                Sube archivos adicionales, graba o fotografía tu pantalla, y descarga los archivos existentes usando el botón de descarga.
            </label>
        </div>

        <div class="px-4 pb-4 pt-10 flex h-full w-full">
            <div class="w-2/4">
                <div id="viewPhoto" style="display: none;">
                    <h2 class="inline-flex font-semibold">
                        Imagen capturada
                    </h2>
                    <div id="renderedCanvas" class="w-full h-auto my-8"></div>
                    {{-- <div class="flex justify-center items-center py-6 bg-main-fund">
                        <button id="downloadButton" class="px-4 py-2 mt-5 font-semibold bg-secondary-fund hover:bg-secondary rounded cursor-pointer" style="color: white;">Guardar captura</button>
                    </div> --}}
                </div>
                
                <div id="viewVideo" style="display: none;">
                    <video id="recording" width="300" height="200" loop autoplay class="my-8 w-full h-2/5"></video>
                    <div class="flex justify-center items-center py-6 hidden">
                        <a id="downloadVideoButton" class="px-4 py-2 font-semibold bg-secondary-fund hover:bg-secondary rounded cursor-pointer" style="color: white;">Descargar video</a>
                    </div>
                </div>

                <div id="viewFile" style="display: block;">
                    @if (!empty($report->content))
                        @if ($report->image == true)
                            <h2 class="inline-flex font-semibold">
                                Imagen capturada
                            </h2>
                            <img name="imageFile" src="{{ asset('reportes/' . $report->content) }}" alt="Report Image">
                            <div class="flex justify-center items-center py-6 ">
                                <a href="{{ asset('reportes/' . $report->content) }}" download="{{ basename($report->content) }}" class="px-4 py-2 mt-5 font-semibold bg-secondary-fund hover:bg-secondary rounded cursor-pointer" style="color: white;">
                                    Descargar captura
                                </a>
                            </div>
                        @endif

                        @if ($report->video == true)
                            @if (strpos($report->content, "Reporte") === 0)
                                <p class="text-red my-5">Falta subir '{{ $report->content }}'</p>
                            @else
                                <video name="videoFile" src="{{ asset('reportes/' . $report->content) }}" loop autoplay alt="Report Video"></video>
                                <div class="flex justify-center items-center py-6 ">
                                    <a href="{{ asset('reportes/' . $report->content) }}" download="{{ basename($report->content) }}" class="px-4 py-2 mt-5 font-semibold bg-secondary-fund hover:bg-secondary rounded cursor-pointer" style="color: white;">
                                        Descargar video
                                    </a>
                                </div>
                            @endif
                        @endif
                        @if ($report->file == true)
                            <iframe src="{{ asset('reportes/' . $report->content) }}" width="100%" height="600"></iframe>
                            <div class="flex justify-center items-center py-6 ">
                                <a href="{{ asset('reportes/' . $report->content) }}" download="{{ basename($report->content) }}" class="px-4 py-2 mt-5 font-semibold bg-secondary-fund hover:bg-secondary rounded cursor-pointer" style="color: white;">
                                    Descargar documento
                                </a>
                            </div>
                        @endif
                    @else
                        <p class="text-red my-5">Sin archivo</p>
                    @endif
                </div>

            </div>
            <div class="w-2/4">
                <form id="formReport" action="{{ route('projects.reports.update', ['project' => $project->id, 'report' => $report->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input hidden type="text" id="user_id" name="user_id" value="{{ $user->id }}">
                    <input hidden type="text" id="inputPhoto" name="photo">
                    <input hidden type="text" id="inputVideo" name="video">

                    <div id="viewText" class="-mx-3 md:flex mb-6" style="block">
                        <div class="md:w-1/2 flex flex-col px-3 mb-6 md:mb-0">
                            <h5 class="inline-flex font-semibold" for="name">
                                Selecciona un archivo
                            </h5>
                            <input type="file" name="file" id="file" value="{{ $report->title }}" class="leading-snug border border-gray-400 block appearance-none bg-white text-gray-700 py-1 px-4 w-full rounded mx-auto">
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/2 flex flex-col px-3 mb-6 md:mb-0">
                            <h5 class="inline-flex font-semibold" for="name">
                                Título del reporte
                            </h5>
                            <input disabled type="text" name="title" id="title" value="{{ $report->title }}" class="leading-snug border border-gray-400 block appearance-none bg-white text-gray-700 py-1 px-4 w-full rounded mx-auto">                        </div>
                        <div class="md:w-1/2 flex flex-col px-3">
                            <h5 class="inline-flex font-semibold" for="name">
                                Descripción del reporte
                            </h5>
                            <textarea disabled type="text" placeholder="Describa la observación y especifique el objetivo a cumplir." class="fields1 leading-snug border border-gray-400 block appearance-none bg-white text-gray-700 pt-1 mb-5 px-4 w-full rounded mx-auto">{{ $report->comment }}</textarea>
                            <textarea required type="text" rows="10" placeholder="Describa la nueva observación y especifique el objetivo a cumplir." name="comment" class="fields1 leading-snug border border-gray-400 block appearance-none bg-white text-gray-700 py-1 px-4 w-full rounded mx-auto"></textarea>

                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-6">
                        <div class="md:w-1/2 flex flex-col px-3 mb-6 md:mb-0">
                            <h5 class="inline-flex font-semibold" for="name">
                                Delegar
                            </h5>
                            <select required name="delegate" id="delegate" class="leading-snug border border-gray-400 block appearance-none bg-white text-gray-700 py-1 px-4 w-full rounded mx-auto">
                                <option value="{{ $report->delegate->id }}" selected>{{ $report->delegate->name }} {{ $report->delegate->lastname }}</option>
                                @foreach ($filteredUsers as $filteredUser)
                                    <option value="{{ $filteredUser->id }}">{{ $filteredUser->name }} {{ $filteredUser->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-center items-center py-6">
                        <button type="submit" class="px-4 py-2 font-semibold bg-secondary-fund hover:bg-secondary rounded cursor-pointer" style="color: white;">Guardar</button>
                    </div>
                </form>            
            </div>
        </div>
    </div>

    <div id="artboard" class="w-full" style="display: none;">
        <h2 class="top-10 left-10 px-2 py-4 font-semibold text-3xl">Previsualización</h2>
        <div class="w-full flex justify-center items-center">
            <p id="log" class="text-xl font-semibold text-red"></p>
            <p id="time" class="mx-3 text-xl font-semibold text-red"></p>
        </div>

        <div id="capturedImageContainer" class="flex items-center justify-center"></div>
        <div id="renderCombinedImage"></div>
    
        <video id="preview" width="100%" height="auto" autoplay muted class="mt-2"></video>
    </div>

    {{-- RECORDING --}}
    <script>
        let preview = document.getElementById("preview");
        let recording = document.getElementById("recording");
        let startButton = document.getElementById("startButton");
        let stopButton = document.getElementById("stopButton");
        let downloadVideoButton = document.getElementById("downloadVideoButton");
        let logElement = document.getElementById("log");
        let time = document.getElementById("time");

        let inputUser = document.getElementById("user_id");
        let inputVideo = document.getElementById("inputVideo");

        let user = @json($user);
        let project = @json($project);

        // variables "globales"
        let startTime, intervalId, mediaRecorder;

        // Nombre del Video con fecha y hora
        let fechaActual = new Date();
        let dia = ("0" + fechaActual.getDate()).slice(-2);
        let mes = ("0" + (fechaActual.getMonth() + 1)).slice(-2);
        let año = fechaActual.getFullYear();
        let horas = ("0" + fechaActual.getHours()).slice(-2);
        let minutos = ("0" + fechaActual.getMinutes()).slice(-2);
        let segundos = ("0" + fechaActual.getSeconds()).slice(-2);
        let fechaEnFormato = dia + '-' + mes + '-' + año + ' ' + horas + '_' + minutos + '_' + segundos;

        // Ayudante para la duración; no ayuda en nada pero muestra algo informativo
        const secondsOnTime = numeroDeSegundos => {
            let horas = Math.floor(numeroDeSegundos / 60 / 60);
            numeroDeSegundos -= horas * 60 * 60;
            let minutos = Math.floor(numeroDeSegundos / 60);
            numeroDeSegundos -= minutos * 60;
            numeroDeSegundos = parseInt(numeroDeSegundos);
            if (horas < 10) horas = "0" + horas;
            if (minutos < 10) minutos = "0" + minutos;
            if (numeroDeSegundos < 10) numeroDeSegundos = "0" + numeroDeSegundos;

            return `${horas}:${minutos}:${numeroDeSegundos}`;
        };

        const refresh = () => {
            time.textContent = secondsOnTime((Date.now() - startTime) / 1000);
        }
        
        const startCounting = () => {
            startTime = Date.now();
            intervalId = setInterval(refresh, 500);
        };

        const stopCounting = () => {
            clearInterval(intervalId);
            startTime = null;
            time.textContent = "";
        }
        
        function log(msg) {
            logElement.innerHTML = msg;
        }

        function startRecording(stream, lengthInMS) {
            mediaRecorder = new MediaRecorder(stream);
            let data = [];

            mediaRecorder.ondataavailable = event => data.push(event.data);

            let stopped = new Promise((resolve, reject) => {
                mediaRecorder.onstop = resolve;
                mediaRecorder.onerror = event => reject(event.name);
            });

            // Manejar el evento oninactive del MediaStream
            stream.oninactive = () => {
                log("Grabación finalizada.");
                stopCounting();
                mediaRecorder.stop();  // Detener la grabación si el stream se vuelve inactivo

                inputUser.value = user.id;
                downloadVideoButton.download = 'Reporte ' + fechaEnFormato + ', ' + project.name;
                inputVideo.value = 'Reporte ' + fechaEnFormato + ', ' + project.name;

                document.getElementById('rightBar').style.display = 'block';
                document.getElementById('artboard').style.display = 'none';

                document.getElementById('viewVideo').style.display = 'block';
                document.getElementById('viewFile').style.display = 'none';
                document.getElementById('viewText').style.display = 'none';
            };

            mediaRecorder.start();
            log("Grabación iniciada.");

            // return stopped;
            return stopped.then(() => data);
        }

        function stop(stream) {
            stream.getTracks().forEach(track => track.stop());
        }

        // Event listener for the stopButton
        stopButton.addEventListener("click", function() {
            stop(preview.srcObject);
        }, false);

        startButton.addEventListener("click", function() {
            navigator.mediaDevices.getDisplayMedia({
                video: { mediaSource: 'screen' },
                audio: true
            }).then(stream => {
                preview.srcObject = stream;
                downloadVideoButton.href = stream;
                preview.captureStream = preview.captureStream || preview.mozCaptureStream;

                // Iniciar la grabación automáticamente cuando se obtiene la captura de pantalla
                startCounting();
                return startRecording(stream);
            }).then (recordedChunks => {
                let recordedBlob = new Blob(recordedChunks, { type: "video/mp4" });
                recording.src = URL.createObjectURL(recordedBlob);
                downloadVideoButton.href = recording.src;
                downloadVideoButton.download = 'Reporte ' + fechaEnFormato + ', ' + project.name;
            })
            /* .catch(log); */
        }, false);

        // returnButton from Video
        document.getElementById('returnButtonVideo').addEventListener('click', function() {
            // Detener el video
            preview.pause();
            preview.srcObject = null;

            if (mediaRecorder) {
                mediaRecorder.stop();
            }
            log('');
            preview.src = '';
            downloadVideoButton.href = '';
            inputVideo.value = '';

            // Mostrar el div principal y ocultar otros elementos
            document.getElementById('rightBar').style.display = 'block';
            document.getElementById('artboard').style.display = 'none';

            document.getElementById('viewVideo').style.display = 'none';
            document.getElementById('viewFile').style.display = 'block';
            document.getElementById('viewText').style.display = 'block';

            document.getElementById('mainMenu').style.display = 'flex';
            document.getElementById('videoMenu').style.display = 'none';
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
            let inputUser = document.getElementById("user_id");

            let user = @json($user);

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

                            // letiables to store previous coordinates
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
                                inputPhoto.value = combinedDataURL;
                                inputUser.value = user.id;
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
                                drawCanvas.hidden = true;
                            });

                            // Function to handle the download
                            // const downloadImage = () => {
                            //     const combinedCanvas = document.createElement('canvas');
                            //     combinedCanvas.width = imageBitmap.width;
                            //     combinedCanvas.height = imageBitmap.height;
                            //     const combinedCtx = combinedCanvas.getContext('2d');

                            //     // Draw the screen capture onto the combined canvas
                            //     combinedCtx.drawImage(imageBitmap, 0, 0);

                            //     // Create a new image element for the drawing canvas
                            //     const drawImage = new Image();
                            //     drawImage.src = drawCanvas.toDataURL('image/jpg');

                            //     // When the drawing canvas image is fully loaded, render it onto the combined canvas
                            //     drawImage.onload = () => {
                            //         combinedCtx.drawImage(drawImage, 0, 0);

                            //         // Get the combined canvas data URL and create a download link
                            //         const combinedDataURL = combinedCanvas.toDataURL('image/jpg');
                            //         const a = document.createElement('a');
                            //         a.href = combinedDataURL;
                            //         a.download = 'Reporte.jpg';
                            //         a.click();
                            //     };
                            // };    
                            // // button with the id "downloadButton"
                            // const downloadButton = document.getElementById('downloadButton');
                            // // Add click event listener to the download button
                            // downloadButton.addEventListener('click', downloadImage);
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
        document.getElementById('formReport').addEventListener('submit', function(e) {
            let downloadButton = document.getElementById('downloadVideoButton');

            if (downloadButton.href) {
                setTimeout(function() {
                    downloadButton.click();
                }, 100);
            }
        });

        //screenshotButton
        document.getElementById('screenshotButton').addEventListener('click', function() {
            document.getElementById('rightBar').style.display = 'none';
            document.getElementById('artboard').style.display = 'block';

            document.getElementById('mainMenu').style.display = 'none';
            document.getElementById('shotMenu').style.display = 'flex';
        });
        //Save combined screenshot-canvas button
        document.getElementById('downloadShot').addEventListener('click', function() {
            document.getElementById('rightBar').style.display = 'block';
            document.getElementById('artboard').style.display = 'none';

            document.getElementById('viewPhoto').style.display = 'block';
            document.getElementById('viewFile').style.display = 'none';
            document.getElementById('viewText').style.display = 'none';
        });
        //returnButton from screenshot
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
            document.getElementById('rightBar').style.display = 'block';
            document.getElementById('artboard').style.display = 'none';

            document.getElementById('viewPhoto').style.display = 'none';
            document.getElementById('viewFile').style.display = 'block';
            document.getElementById('viewText').style.display = 'block';

            document.getElementById('mainMenu').style.display = 'flex';
            document.getElementById('shotMenu').style.display = 'none';
        });

        //start recording video button
        document.getElementById('startButton').addEventListener('click', function() {
            document.getElementById('videoMenu').style.display = 'flex';
            document.getElementById('mainMenu').style.display = 'none';

            document.getElementById('rightBar').style.display = 'none';
            document.getElementById('artboard').style.display = 'block';
        });
    </script>
</body>
</html>