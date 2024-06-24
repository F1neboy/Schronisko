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
        .min>a{
            width: 100%;
            margin-bottom: 3px;
        }

    </style>
</head>

<body>
    @extends('layouts.navbar')
    <div class="container-sm cont-sm">
        @if(Session::has('success'))
            <div class="alert alert-success">{!!Session::get('success')!!}</div>
        @endif
        <h2>Panel admina - zarządzanie przybyłymi psami</h2>
        <div class="table-responsive-sm">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Zdjęcie</th>
                        <th scope="col">Tytuł wydarzenia</th>
                        <th scope="col">Status wydarzenia</th>
                        <th scope="col">Data rozpoczęcia</th>
                        <th scope="col">Data zakończenia</th>
                        <th scope="col" class="min"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>{{$event->id}}</td>
                        <td><img src="{{asset($event->zdjecie)}}" alt=""></td>
                        <td>{{$event->tytul}}</td>
                        <td>{{$event->stan}}</td>
                        <td>{{$event->start_data}}</td>
                        <td>{{$event->end_data}}</td>
                        <td class="min"><a href="panel-wydarzenia/{{$event->id}}" class="btn btn-outline-warning">Edytuj</a><br>
                        <a href="panel-wydarzenia/{{$event->id}}?del=true"  class="btn btn-outline-danger">Usuń</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
    @extends('layouts.footer')
</body>

</html>
