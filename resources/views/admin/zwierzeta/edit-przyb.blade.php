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
        <h2>Edycja przybyłego psa</h2>
        <hr>
        <div class="row mt-3" onload="init()">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4>Data przybycia</h4>
                    <input type="date" class="form-control it-text" name="data" value="{{$dog[0]->data}}">
                    <h4>Płeć psa</h4>
                    <select name="plec" id="" class="form-control it-text">
                        <option value="1" {{ $dog[0]->id_plec===1 ? "selected" : ""}} >Pies</option>
                        <option value="2" {{ $dog[0]->id_plec===2 ? "selected" : ""}} >Suka</option>
                    </select>
                    <hr class="short">
                    <h4>Opis</h4>
                    <textarea id="editor" name="opis" id="" cols="50" rows="10" class="form-control">
                        {{$dog[0]->opis}}
                    </textarea><br>
                <hr class="oddzielacz short">
                <h4>Zdjęcie</h4>
                <img src="{{asset($dog[0]->zdjecie)}}" class="main-image" alt="zdjecie_psa"><br>
                <button type="button" class="btn btn-outline-warning mt-1 mb-2" id="change-main">Zmień zdjęcie</button>
                <div class="col-md-12 mb-3" id="bord">
                        <label for="imgGlowne" class="form-label">Wybierz nowe zdjęcie:</label>
                        <input type="file" name="imgGlowne" class="form-control it-text mb-2">
                </div>
                <div class="mt-2 mb-3">
                    <input type="submit" name="det" class="btn btn-outline-dark" value="Zapisz zmiany">
                </div>
                </form>
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

        btn.onclick = function() {
            if (div.style.display == "none")
                div.style.display = "block";
            else
                div.style.display = "none";
        }

    </script>
</body>
</html>
