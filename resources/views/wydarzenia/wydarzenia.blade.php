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
        .col-md-8{
            background-color: rgba(248,248,248,0.9);
            text-align: center;
            padding-top: 2%;
            height: 300px;
            transition: all .2s ease-in-out;
        }
        .col-md-4{
            background-color: rgba(248,248,248,0.9);
            padding-bottom: 10px;
            padding-top: 10px;
            height: 300px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            object-fit: contain;
        }

        .col-md-4>img {
            max-height: 100%;
            max-width: 100%;
            display: block;
            margin: auto;
        }

        body{
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .cont-sm>.row{
            margin-bottom: 1.5%;
        }
        #con_main>h3{
            margin-top: 8px;
        }
        .last_ev{
            margin-top: 3px;
            margin-bottom: 5px;
        }
        .dog-form{
            background-color: rgba(248,248,248,0.5);
            text-align: center;
            width: auto;
        }
        .dog-form>form>.col-md-5{
            margin: auto;
            left: 0;
            right: 0;

        }
        .dog-form>hr{
            width: 98%;
            margin-left: 1%;
        }
    </style>
</head>
<body>
    @extends('layouts.navbar')
    <div class="container-sm cont-sm">
        @if(Session::has('failure'))
            <div class="alert alert-danger">{!!Session::get('failure')!!}</div>
        @endif
        <h2 class="mt-3">Wydarzenia w schronisku</h2>
        <hr class="last_ev">
        @foreach($currentEvents as $event)
        <div class="row">
           <div class="col-md-4">
                <img src="{{asset($event->zdjecie)}}" alt="post-icon">
           </div>
            <div class="col-md-8">
                <h2>{{$event->tytul}}</h2>
                <p>
                    {{$event->skrocony}}
                </p>
                <p>
                    <i>Czas trwania</i>
                </p>
                <p>
                    <i>{{$event->start_data.' - '.$event->end_data}}</i>
                </p>
                <a href="wydarzenia/{{$event->id}}" class="btn btn-outline-dark">Weź udział</a>
            </div>
        </div>
        @endforeach
        @if(isset($currentEvents[0]))
        <div class="row dog-form">
            <hr>
            <h4>Sprawdź psa dla którego robisz prezent</h4>
            <form action="" method="post">
                @csrf
                <div class="mb-3 col-md-5">
                    <input name="email" type="text" class="form-control" placeholder="Adres e-mail/nick">
                </div>
                <div class="mb-3 col-md-5">
                    <input name="pin" type="text" class="form-control" placeholder="Kod pin">
                </div>
                <input type="submit" value="Sprawdź" class="btn btn-outline-dark mb-3">
            </form>
            <hr>
        </div>
        @else
        <div class="dog-form">
            <h3>Aktualnie brak wydarzeń w schronisku</h3>
        </div>
        @endif
        <h3>Poprzednie wydarzenia</h3>
        <hr class="last_ev">
            @foreach($prevEvents as $prevEvent)
            <div class="row">
            <div class="col-md-4">
                    <img src="{{asset($prevEvent->zdjecie)}}" alt="post-icon">
            </div>
                <div class="col-md-8">
                    <h2>{{$prevEvent->tytul}}</h2>
                    <p>
                        {{$prevEvent->skrocony}}
                    </p>
                    <p>
                        <i>Czas trwania</i>
                    </p>
                    <p>
                        <i>{{$prevEvent->start_data.' '.$prevEvent->end_data}}</i>
                    </p>
                    <a class="btn btn-outline-dark disabled">Czas na udział minął</a>
                </div>
            </div>
            @endforeach
    </div>
    @extends('layouts.footer')
</body>
</html>
