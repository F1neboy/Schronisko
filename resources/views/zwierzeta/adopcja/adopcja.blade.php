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
            background-color: rgba(248,248,248,1);
            padding-bottom: 15px;
        }

        .col-lg-2>a {
            margin-bottom: 2px;
            min-width: 60%;
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
        body{
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        #con_main{
            flex: 1;
        }
        .ud:hover{
            text-decoration: underline;
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
        <h2>Psy do adopcji</h2>
        <hr>
        <div class="row">
            <div class="col-lg-2">
                <h3>Cecha psa:</h3>
                <a href="adopcja" class="btn btn-outline-dark" id="all">Wszystkie</a><br>
                Płeć:<br>
                <a href="adopcja?cat=pp" class="btn btn-outline-dark" id="pp">Pies</a>
                <a href="adopcja?cat=ps" class="btn btn-outline-dark" id="ps">Suczka</a><br>
                Wielkość:<br>
                <a href="adopcja?cat=wm" class="btn btn-outline-dark" id="wm">Mały</a>
                <a href="adopcja?cat=ws" class="btn btn-outline-dark" id="ws">Średni</a>
                <a href="adopcja?cat=wd" class="btn btn-outline-dark" id="wd">Duży</a><br>
                Wiek:<br>
                <a href="adopcja?cat=om" class="btn btn-outline-dark" id="om">Młody</a>
                <a href="adopcja?cat=os" class="btn btn-outline-dark" id="os">Średni</a>
                <a href="adopcja?cat=oss" class="btn btn-outline-dark" id="oss">Stary</a>
            </div>
            <div class="col-lg-10">
                <div class="row dog-cat">
                    @foreach($dogs as $dog)
                    <div class="col-md-4" onclick="location.href='adopcja/{{$dog->id}}';">
                            <img src="{{asset($dog->zdjecie)}}" alt="zdjecie">
                            <h2>{{$dog->imie}}</h2>
                    </div>
                    @endforeach
                </div>
                <div class="rowdog-cat">
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
    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const cat = urlParams.get('cat')
        console.log(cat);
        if(cat=="pp")
            document.getElementById("pp").classList.add("active");
        else if(cat=="ps")
            document.getElementById("ps").classList.add("active");
        else if(cat=="wm")
            document.getElementById("wm").classList.add("active");
        else if(cat=="ws")
            document.getElementById("ws").classList.add("active");
        else if(cat=="wd")
            document.getElementById("wd").classList.add("active");
        else if(cat=="om")
            document.getElementById("om").classList.add("active");
        else if(cat=="os")
            document.getElementById("os").classList.add("active");
        else if(cat=="oss")
            document.getElementById("oss").classList.add("active");
        else
            document.getElementById("all").classList.add("active");
    </script>
</body></html>
