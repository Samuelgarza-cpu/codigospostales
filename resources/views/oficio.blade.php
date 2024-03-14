<!DOCTYPE html>
<html lang="en" style="margin: 0; padding:0;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Oficio</title>
</head>

<body style=" font-family: Arial, Helvetica, sans-serif; background: url({{ public_path('storage/Oficio.jpg') }}); background-position: center; background-size: cover; margin: 0;  padding: 0;" >
    <div style="display: flex; flex-direction: column; margin-top: 130px; align-items: stretch; justify-content: space-evenly; align-content: center; flex-wrap: nowrap; padding: 10px;">
        <div style=" width: 25%; align-self: end; text-align: right; float:right; overflow-wrap: break-word; margin-right: 50px;">
            <h5>
                <b>{{$request->folioInterno}}<br>
                    {{$request->Remitente}} <br>
                    Asunto: El que se indica</b>
            </h5>
        </div>
        <div style="text-align: left; width:60%; display: block; letter-spacing: 1px; overflow-wrap: break-word; margin-top:95px; margin-left: 50px;">
            <h4><b>{{$request->Destinatario}} <br> 
                {{-- {{'DEL ÁREA DE INFORMATICA'}} <br> --}}
                PRESENTE.-</b></h4>
        </div>
        <div style="text-align: center; margin-top: 10px; text-align: justify; margin-left: 50px; margin-right: 50px;">
            <div id="contenido">
               {!!$request->descripcion!!}
            </div> 
        </div>

        <div style="text-align: center; position: absolute; bottom: 200px; width: 100%; ">
            <h4><b>
                ATENTAMENTE <br>
                GÓMEZ PALACIO, DGO., {{$request->fecha}}
            </b></h4>

            <img src="{{ public_path('storage/img_firma-3.jpg') }}" alt="firma" width="75px" height="75px" style="object-fit: contain;">

            <h4><b>
                {{$request->Atentamente}} <br>
                {{$request->Remitente}}
            </b></h4>
        </div>
    </div>
</body>

</html>
