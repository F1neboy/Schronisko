<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Schronisko w Tomarynach</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/navAfot.css">
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery_3.6.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        function mvSite(url) {
            location.href = url;
        }

    </script>
    <style>
        thead {
            border-bottom: 1px solid #000;
        }

        .min {
            white-space: nowrap;
            width: 1%;
        }

        td>img {
            max-height: 10vh;
        }

        .min>button {
            width: 100%;
            margin-bottom: 3px;
        }

        .entry {
            max-height: 300px;
            overflow-x: auto;
        }

        .headStick {
            position: sticky;
            top: -1px;
        }
        .col-md-4{
            margin: auto;
            background-color: rba(200,200,200);
            left: 0;
            right: 0;
            height: 300px;
        }

    </style>
</head>

<body>
    @extends('layouts.navbar')
    <div class="container-sm cont-sm">
        @if(Session::has('denied'))
            <div class="alert alert-danger">{!!Session::get ('denied')!!}</div>
        @endif
        <h2>Logowanie</h2>
        <div class="row">
            <div class="col-md-4 mb-3">
                <form action="" method="post">
                    @csrf
                    <div class="mt-4">
                        <label for="login" class="form-label">Login:</label>
                        <input type="text" class="form-control" name="login">
                    </div>
                    <div class="mt-3">
                        <label for="password" class="form-label">Hasło:</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mt-3">
                        <input type="submit" class="btn btn-outline-dark" value="Zaloguj">
                    </div>
                </form>
            </div>

        </div>


    </div>
    @extends('layouts.footer')
</body>

</html>
