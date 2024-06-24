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
        <h2>Panel admina - dodawanie ogłoszenia poszukiwany/znaleziony</h2>
        <div class="row">
            <div class="col-xl-6">
                <form action="add_posz" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="typ" class="form-label">Rodzaj ogłoszenia</label>
                        <select name="typ" class="form-control" required>
                            <option value="1">Poszukiwany</option>
                            <option value="2">Znaleziony</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rodzaj" class="form-label">Rodzaj zwierzęcia</label>
                        <select name="rodzaj" class="form-control" required>
                            <option value="1">Pies</option>
                            <option value="2">Kot</option>
                            <option value="3">Inne</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="data" class="form-label">Data</label>
                        <input type="date" class="form-control" name="data" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Opis miejsca znalezenia/zaginięcia, opis psa, znaki szczególne i charakterystyczne</label>
                        <textarea name="opis" id="editor" class="form-control" cols="30" rows="10" required>

                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Zdjęcie poszukiwanego/znalezionego</label>
                        <input type="file" class="form-control" name="imgGlowne">
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
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

</script>
</html>
