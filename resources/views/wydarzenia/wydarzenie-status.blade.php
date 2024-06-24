<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Schronisko w Tomarynach</title>
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/custom.css">
        <link rel="stylesheet" href="../../css/navAfot.css">
        <script type="text/javascript" src="../../js/bootstrap.bundle.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            p{
                font-size: 18px;
            }
            .cont-sm{
                text-align: justify;
            }
            .cont-sm>p:first-child{
                margin-top: 40px;
            }
        </style>
    </head>
    <body>
        @extends('layouts.navbar')
        <div class="container-sm cont-sm flex-1">
            <p>Dziękujemy za udział w akcji <b>{{$event[0]->tytul}}</b>. Pies dla które przygotowywujesz prezent to: <b>{{$dog[0]->imie}}</b></p>
            <p>Jeżeli zapomnisz co jest odpowiednie dla Twojego wybrańca, poniżej są dane dzięki, którym przypomnisz sobie co jest dla niego odpowiednie</p>
            <p><b>Email</b>: <i>{{$mail}}</i></p>
            <p><b>Kod pin</b>: <i>{{$pin}}</i></p>
        </div>
        @extends('layouts.footer')
    </body>
</html>
