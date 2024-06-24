<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Schronisko w Tomarynach</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/custom.css">
    <link rel="stylesheet" href="../../css/navAfot.css">
    <script type="text/javascript" src="../../js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .col-md-7 {
            border: 3px #fff solid;
        }

        .main-image {
            height: 30vh;
            width: auto;
        }

        .gallery {
            padding-bottom: 0.2%;
            white-space: wrap;
            display: flex;
            flex-direction: row wrap;
            margin-bottom: 1%;
        }

        .gallery>.col-md-1>img {
            height: auto;
            width: auto;
            height: 15vh;
            cursor: pointer;
            margin-bottom: 3%;
        }

        .col-md-1 {
            display: flex;
            flex-direction: column;
            float: left;
            height: auto;
            width: auto;
            margin-bottom: 2%;
        }

        .col-md-1>.oddzielacz {
            width: 80%;
            text-align: center;
        }

        .it-text {
            width: 30%;
        }

        @media screen and (max-width: 768px) {
            .it-text {
                width: 100%;
            }

        }

        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
            max-height: 400px;
            overflow-x: auto;
        }
        .short{
            width: 30%;
        }

    </style>
</head>
<body>
    @extends('layouts.navbar')
    <div class="container-sm cont-sm">
        @if(Session::has('success'))
            <div class="alert alert-success">{!!Session::get('success')!!}</div>
        @endif
        <h2>Edycja psa do adopcji</h2>
        <hr>
        <div class="row mt-3" onload="init()">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4>Imię psa</h4>
                    <input name="imie" type="text" class="form-control it-text" value="{{$dog[0]->imie}}">
                    <h4>Numer psa</h4>
                    <input name="numer" type="text" class="form-control it-text" value="{{$dog[0]->numer}}">
                    <hr class="short">
                    <h4>Prezenty</h4>
                    <textarea class="form-control it-text" name="prezent" id="" cols="20" rows="8">{!!$dog[0]->prezent!!}</textarea><br>
                    <h4>Opis</h4>
                    <textarea id="editor" name="opis" id="" cols="50" rows="10" class="form-control">
                        {!!$dog[0]->opis!!}
                    </textarea><br>
                    <h4>Podstawowe dane:</h4>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">Data urodzenia</th>
                                <td><input name="wiek" type="date" value="{{$dog[0]->wiek}}" class="form-control it-text"></td>
                            </tr>
                            <tr>
                                <th scope="row">Rasa</th>
                                <td><input name="rasa" type="text" value="{{$dog[0]->rasa}}" class="form-control it-text"></td>
                            </tr>
                            <tr>
                                <th scope="row">Wielkość</th>
                                <td><input name="wielkosc" type="text" value="{{$dog[0]->wielkosc}}" class="form-control it-text"></td>
                            </tr>
                            <tr>
                                <th scope="row">Płeć</th>
                                <td>
                                    <select name="plec" class="form-control it-text">
                                        <option value="1" {{ $dog[0]->id_plec===1 ? "selected" : ""}} >Pies</option>
                                        <option value="2" {{ $dog[0]->id_plec===2 ? "selected" : ""}} >Suka</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Data dodania</th>
                                <td>{{$dog[0]->data_dodania}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr class="oddzielacz short">
                    <h4>Zdjęcie główne</h4>
                    <img src="{{asset($dog[0]->zdjecie)}}" class="main-image" alt="zdjecie_psa"><br>
                    <button type="button" class="btn btn-outline-warning mt-1" id="change-main">Zmień zdjęcie główne</button>
                    <div class="col-md-12" id="bord">
                            <label for="file" class="form-label">Wybierz nowe zdjęcie:</label>
                            <input name="imgGlowne" type="file" class="form-control it-text"><br>
                            <label for="act_mp" class="form-label">
                                Wybierz co zrobić ze starym zdjęciem:
                            </label>
                            <select name="act_mp" id="" class="form-control it-text">
                                <option value="1">Dodaj zdjęcie do pozostałych zdjęć</option>
                                <option value="2">Usuń zdjęcie</option>
                            </select><br>
                    </div>
                    <div class="mt-3">
                        <input type="submit" name="det" class="btn btn-outline-dark" value="Zapisz zmiany">
                    </div>
                </form>

                <hr class="oddzielacz">
                <h4>Pozostałe zdjęcia</h4>
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-warning" id="more-jpg">Dodaj nowe dodatkowe zdjęcia psa</button>
                </div>
                <div id="additional" class="mb-3">
                    <form action="" method="post" name="form"  enctype="multipart/form-data">
                        @csrf
                        <div class="mb-1">
                            <label for="" class="form-label">
                                Wybierz nowe dodatkowe zdjęcia:
                            </label>
                            <input name="imgReszta[]" type="file" class="form-control it-text" multiple>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-outline-dark" name="ap" value="Dodaj!">
                        </div>
                    </form>
                </div>
                <div class="row gallery">
                    @foreach($files as $file)
                    <div class="col-md-1">
                        <img src="{{asset($file)}}" alt="">
                        <a href="?f={{$file}}" class="btn btn-outline-danger">Usuń</a>
                    </div>
                    @endforeach
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    @extends('layouts.footer')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        const div = document.getElementById("bord");
        const btn = document.getElementById("change-main");
        div.style.display = "none";

        const div2 = document.getElementById("additional");
        const btn2 = document.getElementById("more-jpg");
        div2.style.display = "none";

        btn.addEventListener("click", function() {
            disp(div);
        }, false);
        btn2.addEventListener("click", function() {
            disp(div2);
        }, false);

        function disp(abc) {
            if (abc.style.display == "none")
                abc.style.display = "block";
            else
                abc.style.display = "none";
        }

    </script>
</body>

</html>
