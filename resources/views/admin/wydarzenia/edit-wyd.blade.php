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
        .container-sm>row {
            align-content: center;
            justify-content: center;
        }

        td>img {
            max-height: 10vh;
        }

        .ck-editor__editable[role="textbox"] {
            min-height: 200px;
            max-height: 500px;
            overflow-x: auto;
        }

        #list-dog {
            display: none;
        }

        .main-image {
            height: 30vh;
            width: auto;
        }

    </style>
</head>
<body>
    @extends('layouts.navbar')
    <div class="container-sm cont-sm">
        @if(Session::has('success'))
            <div class="alert alert-success">{!!Session::get('success')!!}</div>
        @endif
        <h2>Panel admina - Edycja wydarzenia</h2>
        <div class="row">
            <div class="col-xl-8">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Status wydarzenia</label>
                        <select name="status" id="" class="form-control">
                            <option value="1" {{ $event[0]->id_stan==1? "selected" : ""}}>Przed</option>
                            <option value="2" {{ $event[0]->id_stan==2? "selected" : ""}}>W trakcie</option>
                            <option value="3" {{ $event[0]->id_stan==3? "selected" : ""}}>Zakończone</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tytuł wydarzenia</label>
                        <input type="text" class="form-control" name="tytul" value="{{$event[0]->tytul}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Data rozpoczęcia</label>
                        <input type="date" class="form-control" name="dataS" value="{{$event[0]->start_data}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Data zakończenia</label>
                        <input type="date" class="form-control" name="dataE" value="{{$event[0]->end_data}}">
                    </div>

                    <div class="mb-3">
                        <label for="">Skrócony opis wydarzenia</label>
                        <textarea name="shopis" class="form-control" cols="30" rows="5">{{$event[0]->skrocony}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Opis wydarzenia</label>
                        <textarea name="opis" id="editor" cols="30" rows="10">{{$event[0]->opis}}</textarea>
                    </div>
                    <h4>Zdjęcie wydarzenia</h4>
                    <img src="{{asset($event[0]->zdjecie)}}" class="main-image" alt="zdjecie_psa"><br>
                    <button type="button" class="btn btn-outline-warning mt-1" id="change-main">Zmień zdjęcie główne</button>
                    <div class="col-md-12" id="bord">
                        <label for="" class="form-label">Wybierz nowe zdjęcie:</label>
                        <input type="file" name="imgGlowne" class="form-control it-text"><br>
                    </div>

                    <div class="mb-3 mt-3">
                        <input type="submit" name="det" class="btn btn-primary" value="Zapisz zmiany!">
                    </div>
                    <h4>Lista psów biorąca udział w wydarzeniu</h4>
                    <div class="mb-1">
                        <label for="" class="form-label">
                            Ilość psów z prezentami: {{$stats['sumaZ']}} / {{$stats['suma']}}
                        </label>
                    </div>
                    <button type="button" class="btn btn-outline-dark mb-3" id="show-list">Pokaż listę psów</button>
                    <div class="mb-3" id="list-dog">
                        <div class="table-responsive-sm">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Zdjęcie psa</th>
                                        <th scope="col">Imię psa</th>
                                        <th scope="col">Czy ma prezent</th>
                                        <th scope="col">Adres e-mail</th>
                                        <th scope="col">Kod Pin</th>
                                        <th scope="col">Zmień status prezentu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dogs as $dog)
                                    <tr>
                                        <td>{{$dog->id}}</td>
                                        <td><img src="{{asset($dog->zdjecie)}}" alt=""></td>
                                        <td>{{$dog->imie}}</td>
                                        <td>{{$dog->status}}</td>
                                        <td>{{$dog->email?$dog->email: "---"}}</td>
                                        <td>{{$dog->kod_pin?$dog->kod_pin: "---"}}</td>
                                        <td><a href="/adminPanel/panel-wydarzenia/{{$event[0]->id}}/{{$dog->id}}" name="chng" class="btn btn-outline-warning">Zmień</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @extends('layouts.footer')
</body>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    const bord = document.getElementById("bord");
    const btn_bord = document.getElementById("change-main");
    bord.style.display = "none";

    btn_bord.onclick = function() {
        if (bord.style.display == "none")
            bord.style.display = "block";
        else
            bord.style.display = "none";
    }

    const div = document.getElementById("list-dog");
    const btn = document.getElementById("show-list");
    div.style.display = "none";

    btn.onclick = function() {
        if (div.style.display == "none")
            div.style.display = "block";
        else
            div.style.display = "none";
    }
</script>
</html>
