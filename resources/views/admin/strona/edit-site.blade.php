<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Schronisko w Tomarynach</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/navAfot.css">
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .col-md-3 {
            background-color: darkgoldenrod;
            height: 150px;
            text-align: center;
            transition: all .2s ease-in-out;
            border: 2px #fff solid;
        }

        .col-md-3:hover {
            background-color: darkgrey;
            transform: scale(1.05);
            border: none;
            cursor: pointer;
        }

        .col-md-3>img {
            max-height: 70px;
            margin-top: 15px;
        }

        .col-md-3>p {
            line-height: 4;
            font-weight: 600;
            text-decoration: none;
            color: #000;
        }
        .form-control{
            margin-bottom: 5px;
            width: 30%;
        }
        #slide-img{
            height: 300px;
        }
        @media screen and (max-width:995px){
            #slide-img{
                max-width: 100%;
                height: auto;
            }
        }

    </style>
</head>

<body>
    @extends('layouts.navbar')
    <div class="container-sm cont-sm">
        <h2>Panel admina - edycja strony</h2>
        @if(Session::has('success'))
            <div class="alert alert-success">{!!Session::get('success')!!}</div>
        @endif
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h3>Strona główna</h3>
                <hr style="width: 80%; text-align: center;">
                <h4>Sekcja bannerów</h4>
                <form action="" method="post" id="form" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Ilość zdjęć w banerze</label>
                        <input type="number" name="noPools" class="form-control" value="{{$count}}" id="noPools" onChange="editForm()" min="0" max="5">
                        <input type="submit" class="btn btn-outline-dark" value="Zapisz">
                    </div>
                    @csrf
                    <div id="slides">
                        @foreach($slides as $slide)
                        <div class="mb-3">
                            <label for="" class="form-label">Zdjęcie i opis {{$slide->id}} baneru</label>
                            <input type="text" class="form-control" name="desc-ban{{$slide->id}}" value="{{$slide->opis}}">
                            <img id="slide-img" src="{{asset($slide->zdjecie)}}" alt="slide_photo">
                        </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
    </div>
    @extends('layouts.footer')
</body>
<script>
    function editForm() {
        var form = document.getElementById("slides");
        var noPools = document.getElementById("noPools").value;
        if (noPools >= 0) {
            while (form.childElementCount != noPools) {
                var formPools = form.childElementCount;
                if (form.childElementCount
                 > noPools)
                    form.removeChild(form.lastChild);
                else {
                    formPools++;
                    var div = document.createElement("div");
                    var lbl = document.createElement("label");
                    var input1 = document.createElement("input");
                    var input2 = document.createElement("input");
                    div.setAttribute('class', 'mb-3');
                    lbl.setAttribute('class', 'form-label');
                    lbl.setAttribute('for', '');
                    lbl.innerText = "Zdjęcie i opis " + formPools + " baneru";
                    input1.setAttribute('type', 'file');
                    input1.setAttribute('name', 'img-ban' + formPools);
                    input1.setAttribute('class', 'form-control');
                    input2.setAttribute('type', 'text');
                    input2.setAttribute('name', 'desc-ban' + formPools);
                    input2.setAttribute('class', 'form-control');
                    div.appendChild(lbl);
                    div.appendChild(input2);
                    div.appendChild(input1);
                    form.appendChild(div);

                }
            }
        }
        console.log(form.childElementCount);

    }

</script>

</html>
