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
        .container-fluid {
            padding: 0;
            width: 100%;
            max-height: 250px;
            background-image: url(img/warning.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-color: #FFF;
            text-align: center;
        }

        .container-fluid>h2 {
            line-height: 750%;
            color: #fff;
            background: rgba(0, 0, 0, 0.3);
            margin-bottom: 0;
            max-height: 250px;
        }

        .col-md-12>p {
            text-align: center;
        }
        
        .col-md-4 {
            text-align: center;
            max-width: 100%;
            max-height: 100%;
            padding-top: 2%;
            border: 2px solid transparent;
            background-color: rgba(248,248,248,1);
            transition: all .2s ease-in-out;
        }

        .col-md-4:hover {
            transform: scale(1.02);
            background-color: rgba(169,169,169,1);
            cursor: pointer;
            border: none;   
        }

        .col-md-4>img {
            max-height: 80%;
            max-width: 100%;
        }

        .col-md-3 {
            padding: 0;
            text-align: center;
        }

        .sites {
            text-align: center;
            margin: 20px 0;
        }

        .anone {
            cursor: default;
        }
        .col-lg-2 {
            text-align: center;
            margin-bottom: 3%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .col-lg-2>a {
            margin-bottom: 2px;
            min-width: 60%;
        }
        .col-lg-2>a {
            margin-bottom: 2px;
            min-width: 30%;
        }
        .container-sm{
            background-color: rgb(248,248,248);
        }
        .no-point{
            cursor: default;
            border: none;
        }
        .no-point:hover{
            background-color: rgba(248,248,248,1);
        }

    </style>
</head>

<body>
    @extends('layouts.navbar')
    <div class="container-fluid cont-fl" style="background-image: url({{asset($event[0]->zdjecie)}});">
        <h2>{{$event[0]->tytul}}</h2>
    </div>
    <div class="container-sm pt-3" id="con_main">
        <div class="row">
            <div class="col-md-12">
                {!!$event[0]->opis!!}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center mt-3">Psy biorące udział w akcji</h4>
                <hr>
                <div class="row">
                    @if($dogs->count()==0)
                        <h3 class="mt-3 text-center">Wszystkie psy znalazły już darczyńców. Dziękujemy wszystkiem za zainteresowanie!</h3>
                    @endif
                    @foreach($dogs as $dog)
                        <div class="col-md-4" onclick="location.href='{{$event[0]->id}}/{{$dog->id_psa}}';">
                                <img src="{{asset($dog->zdjecie)}}" alt="post-icon">
                                <h2>{{$dog->imie}}</h2>
                        </div>
                    @endforeach
                </div>
                    <div class="row">
                        <div class="col-md-12 sites">
                            <div class="btn btn-outline-link no-point">Strony</div><br>
                                @foreach($buttons as $button)
                                    {!!$button!!}
                                @endforeach
                            </div>  
                    </div>
            </div>
        </div>
    </div>
    @extends('layouts.footer')
</body>
</html>
