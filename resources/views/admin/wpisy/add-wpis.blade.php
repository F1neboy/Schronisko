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
        <h2>Panel admina - dodawanie wpisu</h2>
        <div class="row">
            <div class="col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Tytuł wpisu</label>
                        <input type="text" class="form-control" name="tytul" required>
                    </div>
                    <div class="mb-3">
                       <label for="">Treść wpisu</label>
                        <textarea name="opis" id="editor" cols="30" rows="10" required>
                            
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Zdjęcie wpisu</label>
                        <input type="file" class="form-control" name="imgGlowne" required>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Dodatkowe zdjęcia</label>
                        <input type="file" class="form-control" multiple name="imgReszta[]">
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
