<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Schronisko w Tomarynach</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/navAfot.css">
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v15.0" nonce="JVCs83wv"></script>
    <style>
        .col-md-6 {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 2%;
            background-color: rgba(0,0,0,0.1);
        }

        .col-md-6>img {
            max-height: 50%;
            max-width: 50%;
            padding-bottom: 2%;
        }
        .col-md-6:hover{
            background-color: rgba(0,0,0,0.2);
        }
        .col-md-3{
            padding: 0;
            text-align: center;
        }
        .sites{
            text-align: center;    
        }
        .anone{
            cursor: default;
        }
        .ud:hover{
            text-decoration: underline;
        }
        .no-point{
            cursor: default;
            border: none;
        }
        .no-point:hover{
            background-color: rgba(248,248,248,1);
        }
    </style>
</head>
<body>
    @extends('layouts.navbar')
    <div class="container-sm cont-sm">
        <h2>Aktualności</h2>
        <hr>
        <div class="row">
            <div class="col-lg-9 order-lg-last">
                <div class="row">
                    @foreach($posts as $post)
                    <div class="col-md-6">
                        <img src="{{asset($post->zdjecie)}}" alt="post-icon">
                        <h2>{{$post->tytul}}</h2>
                        <p>{{$post->tresc}}</p>
                        <a class="btn btn-outline-dark" href="aktualnosci/{{$post->id}}">Czytaj dalej...</a>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-12 sites">
                       <div class="btn btn-outline-link no-point">Strony</div><br>
                        @foreach($buttons as $button)
                            {!!$button!!}
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 p-0 order-lg-first">
                <div class="fb-page" data-href="https://www.facebook.com/SchroniskoBiesal" data-tabs="timeline" data-width="500" data-height="600" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                    <blockquote cite="https://www.facebook.com/SchroniskoBiesal" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/SchroniskoBiesal">Schronisko dla Bezdomnych Zwierząt w Tomarynach</a></blockquote>
                </div>
            </div>
        </div>
    </div>
    @extends('layouts.footer')
</body>
</html>
