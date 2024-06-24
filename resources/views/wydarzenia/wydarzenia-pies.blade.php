<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Schronisko w Tomarynach</title>
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/custom.css">
        <link rel="stylesheet" href="../../css/navAfot.css">
        <script type="text/javascript" src="../../js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/18bf7fdcd9.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .col-md-7 {
                border: 3px transparent solid;
            }

            #main-image {
                padding: 5% 5% 1% 5%;
            }

            #main-image>img {
                max-width: 100%;
                cursor: pointer;
            }

            .gallery {
                padding-bottom: 0.2%;
                white-space: nowrap;
                overflow: auto;
                display: inline-block;
                margin-bottom: 1%;
            }

            .gallery>img {
                max-width: 100%;
                max-height: 100px;
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
        </style>
    </head>
    <body>
        <div id="big-gallery">
            <div id="slide-l">
                <i class="fa-solid fa-angles-left fa-3x"></i>
            </div>
            <div id="slide-r">
                <i class="fa-solid fa-angles-right fa-3x"></i>
            </div>
            <div id="exit">
                <i class="fa-solid fa-xmark fa-3x"></i>
            </div>
            <img src="" alt="slider_zdjecie" id="gal-img">
        </div>
        @extends('layouts.navbar')
        <div class="container-sm cont-sm">
            <h2>{{$tytul}}</h2>
            <hr>
            <div class="row mt-3 row-main">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-9" id="main-image">
                            <img src="{{ asset($pies[0]->zdjecie) }}" alt="zdjecie_psa" id="0">
                        </div>
                        <div class="col-1 slideC order-lg-first" id="left">
                            <i class="fa-solid fa-angles-left fa-2x"></i>
                        </div>
                        <div class="col-1 slideC" id="right">
                            <i class="fa-solid fa-angles-right fa-2x"></i>
                        </div>
                        <div class="col-md-12 gallery scroll-menu" id="scroll-t1">
                            <img src="{{ asset($pies[0]->zdjecie) }}" class="gallery-item" alt="zdjecie_psa">
                            @foreach ($galeria as $img)
                            <img src="{{ asset($img) }}" class="gallery-item" alt="">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                        <h2>{{ $pies[0]->imie }}</h2>
                    <hr>
                    <h3>Zalecane rzeczy dla psa</h3>
                    <p>{{$pies[0]->prezent}}</p>
                    <table class="table table-striped mt-3 mb-3">
                        <tbody>
                            <tr>
                                <th scope="row">Wiek</th>
                                <td>{{$pies[0]->wiek}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Rasa</th>
                                <td>{{$pies[0]->rasa}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Wielkość</th>
                                <td>{{$pies[0]->wielkosc}} cm</td>
                            </tr>
                            <tr>
                                <th scope="row">Płeć</th>
                                <td>{{$pies[0]->plec}}</td>
                            </tr>
                        </tbody>
                    </table>
                    @if($status==1)
                    <form action="" method="post" class="text-center mt-4 mb-4">
                        @csrf
                        <h5>Wpisz poniżej swój adres e-mail lub nick, aby zerezerwować danego psa.</h5>
                        <div class="mt-3">
                            <label for="" class="form-label">E-Mail:</label>
                            <input type="text" name="email" class="form-control">
                            <input type="submit" class="btn btn-outline-dark mt-3"  value="Zarezerwuj psa">
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @extends('layouts.footer')
    </body>
    <script>
        const gallery=document.getElementsByClassName("gallery-item");
        var div=document.getElementById("big-gallery");
        var exit=document.getElementById("exit");
        var galImg=document.getElementById("gal-img");
        var next=document.getElementById("slide-r");
        var prev=document.getElementById("slide-l");
        var div2=document.getElementById("main-image");
        var mnext=document.getElementById("right");
        var mprev=document.getElementById("left");
        div.style.display="none";
        if(window.innerWidth>=768)
            div2.children[0].onclick=function(){slide(0)};
        let i=0;
        var height=0;
        for(let img of gallery){
            img.id=i;
            img.onclick=function(){chngpct(img.id)};
            i++;
        }
        mnext.onclick=function(){move(1)};
        mprev.onclick=function(){move(2)};
        function move(type){
            var id=document.getElementById("main-image").children[0].id;
            if(type==1)
                chngpct(parseInt(id)+1);
            else if(type==2)
                chngpct(parseInt(id)-1);
        }
        function chngpct(id){
            if(id>i-1)
                chngpct(0);
            else if(id<0)
                chngpct(i-1);
            else{
                div2.innerHTML='<img src="'+gallery[id].src+'" id="'+id+'" alt="zdjecie_psa"/>';
                document.getElementById("right").onclick=function(){move(1)};
                document.getElementById("left").onclick=function(){move(2)};
                if(window.innerWidth>=768)
                    div2.children[0].onclick=function(){slide(id)};
            }
        }
        function slide(id){
            if(id>i-1)
                slide(0);
            else if(id<0)
                slide(i-1);
            else{
                var src=gallery[id];
                galImg.src=src.src;
                div.style.display="block";
                exit.onclick=function(){
                    div.style.display="none";};
                next.onclick=function(){
                    slide(parseInt(id)+1);
                };
                prev.onclick=function(){
                    slide(parseInt(id)-1);
                };
            }
        }
    </script>
</html>
