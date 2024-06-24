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
        .ck-editor__editable[role="textbox"] {
            min-height: 200px;
            max-height: 500px;
            overflow-x: auto;
        }
    </style>
</head>

<body>
    @extends('layouts.navbar')
    <div class="container-sm cont-sm">
        <h2>Panel admina - dodawanie psa</h2>
        <div class="row">
            <div class="col-xl-6">
                <form action="add_dog" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Numer psa</label>
                        <input type="text" class="form-control" name="numer" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Imię psa</label>
                        <input type="text" class="form-control" name="imie" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Data urodzenia</label>
                        <input type="date" class="form-control" name="wiek" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Rasa</label>
                        <input type="text" class="form-control" name="rasa" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Wielkość w kłebie</label>
                        <input type="text" class="form-control" name="wielkosc" required>
                    </div>
                    <div class="mb-3">
                        <label for="plec" class="form-label">Płeć psa</label>
                        <select name="plec" id="" class="form-control" required>
                            <option value="1">Pies</option>
                            <option value="2">Suka</option>
                        </select>
                    </div>
                    <div class="mb-3">
                       <label for="">Prezenty dla psa</label>
                        <textarea name="prezent" class="form-control" cols="20" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                       <label for="">Opis psa</label>
                        <textarea name="opis" id="editor" cols="30" rows="10" required>
                            
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Zdjęcie główne</label>
                        <input type="file" class="form-control" id="img-glowne" name="imgGlowne" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Dodatkowe zdjęcia</label>
                        <input type="file" class="form-control" multiple name="imgReszta[]" id="img-reszta">
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" value="Dodaj!">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @extends('layouts.footer')
</body>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</html>
