<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Schronisko w Tomarynach</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/custom.css">
    <link rel="stylesheet" href="../../css/navAfot.css">
    <script type="text/javascript" src="../../js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery_3.6.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        thead {
            border-bottom: 1px solid #000;
        }

        .min {
            white-space: nowrap;
            width: 1%;
        }

        td>img {
            max-height: 10vh;
        }

        .min>button {
            width: 100%;
            margin-bottom: 3px;
        }

        .entry {
            max-height: 300px;
            overflow-x: auto;
        }

        .headStick {
            position: sticky;
            top: -1px;
        }

    </style>
</head>

<body>
    <div class="container-sm cont-sm">
    @extends('layouts.navbar')
        <h2>Panel admina - Statystyki</h2>
        <div class="row">
            <hr>
            <h4>Wejścia na stronę</h4>
            <hr>
            <div class="col-sm-6">
                <div class="table-responsive-sm entry">
                    <table class="table table-hover table-striped">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Okres</th>
                                <th scope="col">Ilość wejść</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Dzisiaj</td>
                                <td>{{$current[0]}}</td>
                            </tr>
                            <tr>
                                <td>Obecny tydzień</td>
                                <td>{{$current[1]}}</td>
                            </tr>
                            <tr>
                                <td>Obecny miesiąc</td>
                                <td>{{$current[2]}}</td>
                            </tr>
                            <tr>
                                <td>Obecny rok</td>
                                <td>{{$current[3]}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="rok" class="form-label">Rok:</label>
                <select onchange="rok()" name="rok" id="rok" class="form-control mb-3">
                    @foreach($years as $elem)
                        <option value="{{$elem->rok}}" {{ $elem->rok==$year ? "selected" : ""}}>{{$elem->rok}}</option>
                    @endforeach
                </select>
                <div class="table-responsive-sm entry">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Okres</th>
                                <th scope="col">Ilość wejść</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=1;$i<=12;$i++)
                            <tr>
                                <td>{{sprintf("%02s",$i).'.'.$year}}</td>
                                <td>{{$yearDet[$i]}}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
        <h4>Wydarzenia</h4>
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <div class="table-responsive-sm entry">
                    <table class="table table-hover table-striped">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Okres</th>
                                <th scope="col">Ilość wejść</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ilość wszystkich wydarzeń</td>
                                <td>{{$events[0]}}</td>
                            </tr>
                            <tr>
                                <td>Ilość przyszłych wydarzeń</td>
                                <td>{{$events[1]}}</td>
                            </tr>
                            <tr>
                                <td>Ilość trwających wydarzeń</td>
                                <td>{{$events[2]}}</td>
                            </tr>
                            <tr>
                                <td>Ilość zakończonych wydarzeń</td>
                                <td>{{$events[3]}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="event" class="form-label">Wydarzenie:</label>
                <select onchange="evt()" name="event" id="event" class="form-control mb-3">
                    @foreach($evNames as $evName)
                        <option value="{{$evName->id}}" {{ $evName->id==$dogs[0] ? "selected" : ""}}>{{$evName->tytul}}</option>
                    @endforeach
                </select>
                <div class="table-responsive-sm entry">
                    <table class="table table-hover table-striped">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Typ psa</th>
                                <th scope="col">Łączna liczba</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Psy z prezentami</td>
                                <td>{{$dogs[1]}}</td>
                            </tr>
                            <tr>
                                <td>Psy bez prezentów</td>
                                <td>{{$dogs[2]}}</td>
                            </tr>
                            <tr>
                                <td>Wszystkie psy w wydarzeniu</td>
                                <td>{{$dogs[3]}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @extends('layouts.footer')
</body>
<script>
    $(function() {
        $("#nav-placeholder").load("nav.html");
    });
    function rok(){
        var year=document.getElementById('rok').value;
        window.location.href = "?year="+year;
    }
    function evt(){
        var evt=document.getElementById('event').value;
        window.location.href = "?event="+evt;
    }

</script>

</html>
