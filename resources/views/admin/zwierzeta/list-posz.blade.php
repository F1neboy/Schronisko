<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Schronisko w Tomarynach</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/navAfot.css">
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .col-md-10{
            text-align: center;
            padding-top: 2%;
            transition: all .2s ease-in-out;
            object-fit: contain;
            display: block;
            height: 100%;
            padding-bottom: 1%;
        }
        .col-md-2{
            text-align: center;
            display: flex;
            height: 100%;
            margin: auto;
        }

        .col-md-2>img {
            max-width: 100%;
            max-height: 22vh;
            flex-shrink: 0;
            display: block;
            margin: auto;
        }
        #con_main>.row{
            margin-bottom: 1.5%;
            padding-bottom: 1%;
        }
        #con_main>h3{
            margin-top: 6%;
        }
        .last_ev{
            margin-top: 15px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    @extends('layouts.navbar')
    <div class="container-sm cont-sm" id="con_main">
        @if(Session::has('success'))
            <div class="alert alert-success">{!!Session::get('success')!!}</div>
        @endif
        <h2>Lista oczekujących zgłoszeń poszukiwany/znaleziony</h2>
        <hr class="last_ev">
        @foreach($dogs as $dog)
        <div class="row">
           <div class="col-md-2">
                <img src="{{asset($dog->zdjecie)}}" alt="post-icon">
           </div>
            <div class="col-md-10">
                <h2>{{$dog->typ.' '.$dog->rodzaj.' '.$dog->data}}</h2>
                <p>{{ $dog->opis }}</p>
                <a href="list-posz/{{$dog->id}}" class="btn btn-outline-dark">Więcej</a>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    @extends('layouts.footer')
</body>
</html>
