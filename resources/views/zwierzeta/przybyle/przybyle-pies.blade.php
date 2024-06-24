<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Schronisko w Tomarynach</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/navAfot.css">
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="../width=device-width, initial-scale=1">
    <style>
        .container-sm {
            flex: 1;
        }
        .col-md-7 {
            border: 3px transparent solid;
        }

        .main-image {
            padding: 5% 5% 1% 5%;
            display: flex;
            align-content: center;
            justify-content: center;
        }

        .main-image>img {
            max-width: 70%;
            cursor: pointer;
        }

        .col-md-7>hr {
            width: 80%;
            text-align: center;
        }

        #scroll-t1::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        #scroll-t1::-webkit-scrollbar {
            padding: inherit;
            height: 12px;
            background-color: #f5f5f5;
        }

        #scroll-t1::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #555;
        }
        .col-md-12>button{
            margin: 0 5%;
        }

    </style>
</head>
<body>
    @extends('layouts.navbar')
    <div class="container-sm cont-sm">
        <h2>Przybyły do schroniska </h2>
        <hr>
        <div class="row mt-3">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-12 main-image">
                        <img src="{{asset($pies[0]->zdjecie)}}" alt="zdjecie_psa">
                    </div>
                </div>
            </div>
            <div class="col-md-7">   
                <hr>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">Płeć psa</th>
                            <td>{{$pies[0]->plec}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Data przybycia</th>
                            <td>{{$pies[0]->data}}</td>
                        </tr>
                    </tbody>
                </table>
                {!!$pies[0]->opis!!}
            </div>
        </div>
    </div>
    @extends('layouts.footer')
</body>
</html>
