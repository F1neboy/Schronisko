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
        .btn:hover{
            background-color: rgba(169,169,169,1);
            color: #000;
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
            min-width: 80%;
        }
        
        @media screen and (max-width: 912px) {
            .col-lg-2{
                display: inline-block;
            }
            .col-lg-2>a {
                margin-bottom: 2px;
                min-width: 30%;
            } 
        }
        h2{
            text-align: center;
            font-family: Helvetica, 'Times New Roman', Times, sans-serif;
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
        <h2>Znaleziony/Poszukiwany</h2>
        <hr>
        <div class="row">
            <div class="col-lg-2">
                <h4>Status ogłoszenia</h4>
                <a href="poszukiwane" class="btn btn-outline-dark" id="wszystkie">Wszystkie</a>
                <a href="poszukiwane?cat=znal" class="btn btn-outline-dark" id="znal">Znaleziony</a>
                <a href="poszukiwane?cat=posz" class="btn btn-outline-dark" id="posz">Poszukiwany</a>
            </div>
            <div class="col-lg-10">
                <div class="row">
                    @foreach($dogs as $dog) 
                    <div class="col-md-4" onclick="location.href='poszukiwane/{{$dog->id}}';">
                            <img src="{{asset($dog->zdjecie)}}" alt="post-icon">
                            <h2>{{$dog->typ." ".$dog->rodzaj}}</h2>
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
    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const cat = urlParams.get('cat')
        console.log(cat);
        if(cat=="znal")
            document.getElementById("znal").classList.add("active");
        else if(cat=="posz")
            document.getElementById("posz").classList.add("active");
        else
            document.getElementById("wszystkie").classList.add("active");
    </script>
</body></html>
