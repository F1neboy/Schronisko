<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Schronisko w Tomarynach</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/navAfot.css">
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/18bf7fdcd9.js" crossorigin="anonymous"></script>
    <script>
        function mvSite(url) {
            window.location.href=url;
        }

    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .col-md-3 {
            height: 150px;
            text-align: center;
            transition: all .2s ease-in-out;
            border: 2px transparent solid;
        }

        .col-md-3:hover {
            background-color: darkgrey;
            transform: scale(1.05);
            cursor: pointer;
            border-radius: 5px;
        }

        .col-md-3>img {
            max-height: 70px;
            margin-top: 15px;
        }

        .col-md-3>p {
            line-height: 4;
            font-weight: 600;
            text-decoration: none;
            color: #000;
        }
        .row>h3{
            text-align: center;
        }
        .w-80{
            width: 80%;
            margin-left: 10%;
        }
        .w-55{
            width: 55%;
            margin-left: 22.5%;
        }
    </style>
</head>

<body>
    @extends('layouts.navbar')
    <div class="container-sm cont-sm">
        <h2>Panel admina</h2>
        <div class="alert alert-info" id="alert" role="alert">
            Jesteś zalogowany jako <b>{{Session::get('user')}}</b>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success">{!!Session::get('success')!!}</div>
        @endif
        <div class="row">
           <h3>Strona</h3>
           <hr class="w-80">
           <hr class="w-55">
            <div class="col-md-3" onclick="mvSite('adminPanel/edit-site')">
                <i class="fa-solid fa-gear fa-4x mt-3"></i>
                <i class="fa-solid fa-bars"></i>
                <p>Edycja strony</p>
            </div>
            <h3>Zwierzęta</h3>
           <hr class="w-80">
           <hr class="w-55">
            <div class="col-md-3" onclick="mvSite('adminPanel/add-dog')">
                <i class="fa-solid fa-plus fa-4x mt-3"></i>
                <i class="fa-solid fa-dog mt-3"></i>
                <p>Dodaj psa do adopcji</p>
            </div>
            <div class="col-md-3" onclick="mvSite('adminPanel/add-przyb')">
                <i class="fa-solid fa-plus fa-4x mt-3"></i>
                <i class="fa-solid fa-arrow-left mt-3"></i>
                <p>Dodaj nowo przybyłego psa</p>
            </div>
            <div class="col-md-3" onclick="mvSite('adminPanel/add-posz')">
                <i class="fa-solid fa-plus fa-4x mt-3"></i>
                <i class="fa-solid fa-question mt-3"></i>
                <p>Dodaj poszukiwany/znaleziony</p>
            </div>
            <div class="col-md-3" onclick="mvSite('adminPanel/list-posz')">
                <i class="fa-solid fa-4x fa-list mt-3"></i>
                <i class="fa-solid fa-question mt-3"></i>
                <p>Zgłoszenia poszukiwane/znaleziony</p>
            </div>
            <div class="col-md-3" onclick="mvSite('adminPanel/panel-adopcja')">
                <i class="fa-solid fa-gear fa-4x mt-3"></i>
                <i class="fa-solid fa-dog mt-3"></i>
                <p>Adopcja- zarządzanie</p>
            </div>
            <div class="col-md-3" onclick="mvSite('adminPanel/panel-przybyle')">
                <i class="fa-solid fa-gear fa-4x mt-3"></i>
                <i class="fa-solid fa-arrow-left mt-3"></i>
                <p>Przybyłe- zarządzanie</p>
            </div>
            <div class="col-md-3" onclick="mvSite('adminPanel/panel-poszukiwane')">
                <i class="fa-solid fa-gear fa-4x mt-3"></i>
                <i class="fa-solid fa-question mt-3"></i>
                <p>Poszukiwane/znalezione- zarządzanie</p>
            </div>
            <h3>Wydarzenia</h3>
           <hr class="w-80">
           <hr class="w-55">
            <div class="col-md-3" onclick="mvSite('adminPanel/add-wydarzenie')">
                <i class="fa-solid fa-calendar-plus fa-4x mt-3"></i>
                <p>Utwórz wydarzenie</p>
            </div>
            <div class="col-md-3" onclick="mvSite('adminPanel/panel-wydarzenia')">
                <i class="fa-solid fa-gear fa-4x mt-3"></i>
                <i class="fa-solid fa-calendar"></i>
                <p>Wydarzenia - zarządzanie</p>
            </div>
            <h3>Aktulności i wpisy</h3>
           <hr class="w-80">
           <hr class="w-55">
            <div class="col-md-3" onclick="mvSite('adminPanel/add-wpis')">
                <i class="fa-solid fa-file-circle-plus fa-4x mt-3"></i>
                <p>Nowy wpis</p>
            </div>
            <div class="col-md-3" onclick="mvSite('adminPanel/panel-wpisy')">
                <i class="fa-solid fa-gear fa-4x mt-3"></i>
                <i class="fa-solid fa-file"></i>
                <p>Wpisy - zarządzanie</p>
            </div>
            <h3>Statystyki</h3>
           <hr class="w-80">
           <hr class="w-55">
            <div class="col-md-3" onclick="mvSite('adminPanel/statistics')">
                <i class="fa-solid fa-signal fa-4x mt-3"></i>
                <p>Statystyki strony</p>
            </div>
        </div>
    </div>
    @extends('layouts.footer')
</body>
</html>
