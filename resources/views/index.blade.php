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
        .typical {
            background-color: darkgrey;
            height: auto;
            text-align: center;
            padding-top: 50px;
        }

        .col-md-8 {
            background-color: lightgrey;
            height: 350px;
        }
        .form_zglo{
            width: 75%;
            text-align: center;
            margin: auto;
            left: 0;
            background-color: lightgrey;
            margin-bottom: 10px;
        }
        @media screen and (max-width: 992px) {
            .form_zglo{
                width: 100%;
            }
        }
        #alert{
            width: 80%;
            margin: auto;
            left: 0;
            right: 0;
        }
        .icon{
            background-color: rgba(0,0,0,0.7);
            height: 70px;
        }
        .carousel-caption>h3{
            color: #000;
            font-weight: 100;
            background-color: rgba(255,255,255,0.50);
        }
        .post{
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgba(0,0,0,0);
            height: auto;
        }
        @media screen and (max-width: 489px){
            .post{
                padding-bottom: 2%;
            }
        }
        .post>img {
            max-height: 50%;
            max-width: 50%;
            padding-bottom: 2%;
        }
        .post:hover{
            background-color: rgba(0,0,0,0.2);
        }
        .news{
            background-color: rgba(248,248,248,1);
        }
        .typical>hr{
            height: 30px;
            margin: 0;
            padding: 0;
            text-align: center;
            width: 80%;
            margin-left: 10%;
            border-width: 3px;
            margin-top: 10px;
        }
        .main-div{
            min-height: 300px;
            background-color: rgb(230,230,230);
        }
        .main-div>h3{
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;
        }
        .main-div>hr{
            width: 70%;
            margin-left: 15%;
        }
        .news>hr{
            width: 70%;
            margin-left: 15%;
            
        }
        .news{
            height: auto;
        }
        .main-div>p{
            font-size: 20px;
            margin: 0 6.5%;
            text-align: center;
        }
        @font-face {
            font-family: Pacifico;
            src: url(../fonts/Pacifico-Regular.ttf);
        }
        .main-div>p:last-child{
            font-family: Pacifico;
            font-size: 25px;
        }
        .typical-2{
            padding: 2.5% 10%;
            height: auto;
            margin: auto;
            font-size: 18px;
        }
        .dogs>.dog{
            max-height: 70%;
            max-width: 100%;
        }
        .dogs{
            text-align: center;
            max-width: 100%;
            max-height: 100%;
            padding-top: 1%;
            padding-bottom: 1%;
            border: 2px solid transparent;
            background-color: rgba(248,248,248,1);
        }
        .dogs:hover{
            background-color: rgba(0,0,0,0.2);
        }
    </style>
</head>

<body>
    @extends('layouts.navbar')
    <div class="container-fluid cont-fl">
        @if(Session::has('success'))
            <div class="alert alert-success mt-2" id='alert'>{!!Session::get('success')!!}</div>
        @endif
        <div id="carouselExampleControls" class="carousel slide mb-3 mt-3" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($slides as $slide)
                @if($slide->id==1)
                <div class="carousel-item active">
                    <img class="d-block h-10 w-100" src="{{asset($slide->zdjecie)}}" alt="{{$slide->id}} slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>{{$slide->opis}}</h3>
                    </div>
                </div>
                @else
                <div class="carousel-item">
                    <img class="d-block h-10 w-100 " src="{{asset($slide->zdjecie)}}" alt="{{$slide->id}} slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{$slide->opis}}</h5>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            @if($count>1)
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </a>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12 main-div">
                <h3>Witaj na stronie schroniska w Tomarynach</h3>
                <hr>
                <p>Nasze schronisko działa na rzecz zwierząt oraz ochrony środowiska. Staramy się zapewnić opiekę i bezpieczeństwo zwierzętom domowym z większości gmin wokół Olsztyna.
                    Schronisko w Tomarynach to miejsce przyjazne zwierzętom, ale nie powinno stanowić dla nich prawdziwego domu.</p>
                    <p>Zapraszamy do sprawdzenia naszych podopiecznych w zakładce Zwierzęta/Adopcja oraz sprawdzenia wszelkich pozostałych stron m.in. O schronisku/wsparcie</p>
                    <br>
                    <p><i class="fa-solid fa-diamond fa-2xs"></i>  Całego świata nie zmienisz, ale możesz zmienić cały świat dla jednego z naszych psów.  <i class="fa-solid fa-diamond fa-2xs"></i></p>
            </div>
        </div>
        <div class="row news">
            <div class="col-md-12 text-center mt-3 mb-3"><h3><i class="fa-solid fa-paw"></i>  Aktualności  <i class="fa-solid fa-paw"></i></h3></div><hr>
            @foreach($posts as $post)
            <div class="col-md-4 post">
                <img src="{{asset($post->zdjecie)}}" alt="post-icon">
                <h2>{{$post->tytul}}</h2>
                <p>{{$post->tresc}}</p>
                <a class="btn btn-outline-dark" href="aktualnosci/{{$post->id}}">Czytaj dalej...</a>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-4 typical order-md-last">
                <i class="fa-solid fa-circle-exclamation fa-10x"></i>
                <hr>
                <h2>Przydatne informacje</h2>
            </div>
            <div class="col-md-8 typical-2 order-md-first">
                <p><i class="fa-solid fa-diamond fa-2xs"></i> Zanim przyjedziesz do schroniska w celu adopcji, sprawdź naszych podopiecznych na naszej stronie. 
                Ułatwi Ci to w znalezieniu nowego przyjaciela</p>
                <p><i class="fa-solid fa-diamond fa-2xs"></i> Pamiętaj, adopcja to nie jest łatwy czas dla psa. Nie rozumie twoich intencji i jest zdezorientowany nową sytuacją.</p>
                <p><i class="fa-solid fa-diamond fa-2xs"></i> Pies to żywe stworzenie i podobnie jak ludzie ma uczucia. Nie traktuj go jak chwilowej zabawki.</p>
                <p><i class="fa-solid fa-diamond fa-2xs"></i> Kiedy widzisz zagubione zwierze, nie bądź dla niego obojętny i spróbuj mu pomóc.
                Dane kontaktowe do schroniska znajdziesz w zakładce O schronisku/Kontakt.</p>
            </div>
        </div>
        <div class="row news">
            <div class="col-md-12 text-center mt-3 mb-3">
                <h3><i class="fa-solid fa-paw"></i> Nowi mieszkańcy schroniska <i class="fa-solid fa-paw"></i></h3>
            </div>
            <hr>
            @foreach($dogs as $dog)
            <div class="col-md-4 dogs">
                <img src="{{asset($dog->zdjecie)}}" class="dog" alt="post-icon">
                <h2>{{$dog->imie}}</h2>
                <a class="btn btn-outline-dark" href="adopcja/{{$dog->id}}">Sprawdź więcej</a>
            </div>
            @endforeach
        </div>
        <form action="" method="post" style="bacground-color: white;" enctype="multipart/form-data">
        @csrf
            <div class="row form_zglo pt-3">
            <h3>Formularz zgłoszenia zaginięcia lub odnalezienia psa</h3>
                <div class="col-md">
                    <label for="zgtypl" class="form-label">Rodzaj zgłoszenia</label>
                    <select name="typ" id="" class="form-control" required>
                        <option value="1">Poszukiwany</option>
                        <option value="2">Znaleziony</option>
                    </select>
                </div>
                <div class="col-md">
                    <label for="rodzaj" class="form-label">Rodzaj zwierzęcia</label>
                    <select name="rodzaj" id="" class="form-control" required>
                        <option value="1">Pies</option>
                        <option value="2">Kot</option>
                        <option value="3">Inne</option>
                    </select>
                </div>
                <div class="col-md">
                    <label for="data" class="form-label">Data zdarzenia</label>
                    <input type="date" name="data" class="form-control" required>
                </div>
                <div class="mb-3 mt-3">
                    <label for="opis" class="form-label">Opis zwierzęcia, miejsca zdarzenia, daty i czasu oraz dane kontaktowe.</label>
                    <textarea name="opis" id="" cols="30" rows="10" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="imgGlowne" class="form-label">Zdjęcie zwierzęcia</label>
                    <input type="file" name="imgGlowne" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="submit" value="Wyślij" class="btn btn-outline-dark">
                </div>
            </div>
        </form>
    </div>
    @extends('layouts.footer')
</body>
<script>
    const div=document.getElementById('alert');
    if(div!=null){
        setTimeout(function(){
            div.remove();
        }, 5*1000);
    }
</script>

</html>
