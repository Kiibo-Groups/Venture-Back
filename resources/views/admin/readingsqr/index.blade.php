
@extends('layouts.app')
@section('title') Lector de QR @endsection
@section('page_active') Lector de QR @endsection 
@section('subpage_active') Lector @endsection 


@section('styles')
    <style>
        .card-reader{
           
            padding: 10px;
            border-radius: 20px; 
        }
        .card-reader img{
            border-radius: 15px;
        }
    
        #input-scan {
            margin: auto;
            position: absolute;
            top: 60px;
            right: 0;
            left: 0;
            background: transparent;
            border: transparent;

        }
    </style>
@endsection

 
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-sm-8">
            <div class="card card-reader">
                <div class="card-body text-center">
                    <h4 class="header-title mt-0 mb-3">
                        Esperando Lectura del dispositivo
                    </h4>

                    <input type="text" id="input-scan">

                    <iframe id="iframeScan" src="https://embed.lottiefiles.com/animation/5427"></iframe>

                    <video id="preview" style="display: none; width: 360px; height: 500px; background: rgb(0, 0, 0); border-radius: 45px; transform: scaleX(-1);margin: auto;"></video> 
                    <div class="card-content" style="padding-top: 25px">
                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="initSacn()">
                            <span id="label-scann">
                                <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Iniciar camara
                            </span>
                        </button>


                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="UseScan()">
                            <span id="label-scann">
                                <span class="btn-label"><i class="mdi mdi-scan-helper"></i></span>Utilizar Scanner
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<!-- container-fluid -->
@endsection 


@section('scripts')
<script type="text/javascript" src="{{ asset('resources/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/js/instascan.min.js') }}"></script>
 
<script>
    var sound = new Audio('{{ asset("resources/data/scan.mp3") }}');
    var ScannFlag
    var Input = document.getElementById('input-scan');


    $(document).ready(function() {
        
       setTimeout(() => {
        Input.value = "";
        $("#input-scan").focus();
       }, 1000);
    });

    function UseScan() {
        Input.value = "";
        $("#input-scan").focus();
    }
    // Inisializacion del Scann
    let scanner = new Instascan.Scanner(
        {
            // Whether to scan continuously for QR codes. If false, use scanner.scan() to manually scan.
            // If true, the scanner emits the "scan" event when a QR code is scanned. Default true.
            continuous: true,
            
            // The HTML element to use for the camera's video preview. Must be a <video> element.
            // When the camera is active, this element will have the "active" CSS class, otherwise,
            // it will have the "inactive" class. By default, an invisible element will be created to
            // host the video.
            video: document.getElementById('preview'),
            
            // Whether to horizontally mirror the video preview. This is helpful when trying to
            // scan a QR code with a user-facing camera. Default true.
            mirror: true,
            
            // Whether to include the scanned image data as part of the scan result. See the "scan" event
            // for image format details. Default false.
            captureImage: false,
            
            // Only applies to continuous mode. Whether to actively scan when the tab is not active.
            // When false, this reduces CPU usage when the tab is not active. Default true.
            backgroundScan: true,
            
            // Only applies to continuous mode. The period, in milliseconds, before the same QR code
            // will be recognized in succession. Default 5000 (5 seconds).
            refractoryPeriod: 5000,
            
            // Only applies to continuous mode. The period, in rendered frames, between scans. A lower scan period
            // increases CPU usage but makes scan response faster. Default 1 (i.e. analyze every frame).
            scanPeriod: 1
        }
    );

    /**
     * 
     * Eventos del Input para el lector fisico
     * 
     **/
    Input.addEventListener("input", function(content) {
        QRValidate(content.target.value);
    });
    

    /**
     * 
     * Eventos del scann para lectro web
     * 
     **/
    scanner.addListener("scan", function(content) {
        sound.play();
        QRValidate(content);
    });

    function initSacn(){
        let video   = document.getElementById('preview');
        let Iframe  = document.getElementById('iframeScan');
        let label   = document.getElementById('label-scann');

        if (!ScannFlag) {    
            ScannFlag = true;
            Iframe.style.display = 'none';
            video.style.display = 'block';
            label.innerHTML = '<span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span>Detener Scann';
            
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                    alert("no cameras found.");
                }
            }).catch(function (e) {
                console.error(e);
            });
        }else {
            location.reload();
        }
    }
 
        
    /**
     * 
     * Peticion al Back para validar QR
     * 
     **/
    function QRValidate(content)
    {
        
        console.log(content);
        fetch('./validateqr', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify(content)
        })
        .then(response => response.json())
        .then((data) => {
            console.log(data)
            Input.value = "";
            if (data.status == 200) {
                Swal.fire({
                    icon: "success",
                    title: 'Confirmado',
                    text: "El código ha sido validado con éxito.",
                    type: 'success',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500,
                });
            }else if (data.status == 400) {
                Swal.fire({
                    icon: "warning",
                    title: 'Código no válido.',
                    text: "El código que intentas canjear ya ha sido usando.",
                    type: 'warning',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500,
                });
            }else {
                Swal.fire({
                    icon: "error",
                    title: 'Código no válido.',
                    text: "El código no ha podido ser validado.",
                    type: 'error',
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 1500,
                });
            }

            
            
        });
 
    } 
</script>
@endsection 