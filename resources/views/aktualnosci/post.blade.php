<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Schronisko w Tomarynach</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/navAfot.css">
    <script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/18bf7fdcd9.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .container-fluid {
            padding-left: 0;
            padding-right: 0;
            width: 100%;
            min-height: 300px;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-color: rgba(0,0,0,0.4);
            background-blend-mode: overlay;
        }

        .container-fluid>h2 {
            line-height: 1200%;
            padding-left: 10%;
            color: #fff;
            margin-bottom: 0;
            height: 300px;
        }

        .col-md-3 {
            border-right: 1px solid #C8C9CA;
        }

        .rmain {
            margin-bottom: 3%;
        }

        @media screen and (max-width: 768px) {
            .col-md-12 {
                border-bottom: 1px solid #C8C9CA;
            }

            .col-md-3 {
                border-right: none;
            }
        }
        .gallery>.col-md-12>img {
            width: 20%;
        }

        .gallery>.col-md-12>img:hover {
            opacity: 0.5;
            cursor: pointer;
        }

        .gallery>.col-md-12 {
            height: auto;
        }
        .list-group-item{
            border: none;
            background-color: rgb(248,248,248);
        }
        .list-group-item:hover{
            background-color: rgb(255,255,255);
            color: #000;
        }
        .container-sm{
            background-color: rgb(248,248,248);
            flex: 1;
        }
    </style>
</head>

<body>
    @extends('layouts.navbar')
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
    <div class="container-fluid cont-fl" style="background-image: url({{asset($post[0]->zdjecie)}})">
        <h2>{{$post[0]->tytul}}</h2>
    </div>
    <div class="container-sm pt-3">
        <div class="row rmain">
            <div class="col-md-9 order-md-last">
                <div class="row">
                    <div class="col-md-12">
                       <p><i>Data dodania: {{$post[0]->data_dodania}}</i></p>
                       {!!$post[0]->tresc!!}
                    </div>
                </div>
                <div class="row gallery">
                    <div class="col-md-12">
                        <h3>Zdjęcia artykułu:</h3>
                        @foreach($files as $file)
                            <img src="{{asset($file)}}"  class="gallery-item" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-3 order-md-first">
                <h2>Ostatnie wpisy:</h2>
                <div class="list-group">
                    @foreach($lastPosts as $post)
                        <a href="{{$post->id}}" class="list-group-item list-group-item-action"><li>{{$post->tytul}}</li></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @extends('layouts.footer')
    <script>
        const gallery=document.getElementsByClassName("gallery-item");
        var div=document.getElementById("big-gallery");
        var exit=document.getElementById("exit");
        var galImg=document.getElementById("gal-img");
        var next=document.getElementById("slide-r");
        var prev=document.getElementById("slide-l");
        div.style.display="none";
        let i=0;
        for(let img of gallery){
            img.id=i;
            img.onclick=function(){slide(img.id)};
            i++;
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
</body>
</html>
