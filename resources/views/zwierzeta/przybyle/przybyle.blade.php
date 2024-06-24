<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Schronisko w Tomarynach</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/navAfot.css">
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
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
            max-height: 85%;
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
    <div class="container-sm cont-sm" id="con_main">
        <h2>Przybyłe do schroniska</h2>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @foreach($dogs as $dog)                
                    <div class="col-md-4" onclick="location.href='przybyle/{{$dog->id}}';">
                            <img src="{{asset($dog->zdjecie)}}" alt="post-icon">
                            <h2>{{ $dog->plec." ".$dog->data }}</h2>
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
        @extends('layouts.footer')
    </div>
</body>
</html>
