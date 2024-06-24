<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Schronisko w Tomarynach</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/navAfot.css">
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
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
        #list-dog{
            display: none;
        }
    </style>
</head>
<body>
    @extends('layouts.navbar')
    <div class="container-sm cont-sm">
        <h2>Panel admina - Tworzenie wydarzenia</h2>
        <div class="row">
            <div class="col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Tytuł wydarzenia</label>
                        <input type="text" name="tytul" class="form-control" name="numer" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Data rozpoczęcia</label>
                        <input type="date" name="data_st" class="form-control" name="imie" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Data zakończenia</label>
                        <input type="date" name="data_end" class="form-control" name="wiek" required>
                    </div>

                    <div class="mb-3">
                        <label for="">Skrócony opis wydarzenia</label>
                        <textarea name="shopis" class="form-control" cols="30" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Opis wydarzenia</label>
                        <textarea name="opis" id="editor" cols="30" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Zdjęcie Wydarzenia</label>
                        <input type="file" name="imgGlowne" class="form-control" name="img-glowne" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Dodaj!">
                    </div>
                    <h4>Lista psów biorąca udział w wydarzeniu</h4>
                    <button type="button" class="btn btn-outline-dark mb-3" id="show-list">Pokaż listę psów</button>
                    <div class="mb-3" id="list-dog">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" id="all"></th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Zdjęcie psa</th>
                                    <th scope="col">Imię psa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dogs as $dog)
                                <tr>
                                    <td><input type="checkbox" name="d{{$dog->id}}" class="o-dog"></td>
                                    <td>{{$dog->id}}</td>
                                    <td><img src="{{asset($dog->zdjecie)}}" alt=""></td>
                                    <td>{{$dog->imie}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    

        const div = document.getElementById("list-dog");
        const btn = document.getElementById("show-list");
        div.style.display = "none";
    
        btn.onclick = function() {
            if (div.style.display == "none")
                div.style.display = "block";
            else
                div.style.display = "none";
        }
        const sel_all = document.getElementById("all");
        const dogs = document.getElementsByClassName("o-dog");
        sel_all.onchange = function(){
            Array.prototype.forEach.call(dogs, function(dog){
            if(sel_all.checked==true)
                dog.checked=true;
            else
                dog.checked=false;
                
            })
        }

</script>
</html>
