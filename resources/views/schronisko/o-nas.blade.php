<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Schronisko w Tomarynach</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/navAfot.css">
    <script type="application/javascript" src="js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .container-fluid {
            padding-left: 0;
            padding-right: 0;
            width: 100%;
            min-height: 300px;
            background-image: url(img/o-nas_back.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        .container-fluid>h2 {
            line-height: 1200%;
            padding-left: 10%;
            color: #fff;
            background: rgba(0,0,0,0.3);
            margin-bottom: 0;
            height: 300px;
        }
        .container-fluid>hr{
            border-width: px;
            color: #fff;
            width: 80%;
            opacity: 1;
            margin: auto;
            top: 0;
        }
        h2>p{
            padding-top: 150px;
            border-bottom: solid 1px #fff;
            line-height: 50px;
        }
        .row{
            margin-top:2%;
        }
        .container-sm{
            background-color: rgb(248,248,248);
            padding-left: 5%;
            padding-right: 5%;
            font-size: 18px;
        }
    </style>
</head>

<body>
    @extends('layouts.navbar')
    <div class="container-fluid cont-fl">
        <h2>
            <p>O nas</p>
        </h2>
    </div>
    <div class="container-sm">
        <div class="row">
            <p>
                Schronisko dla Bezdomnych Zwierząt w Tomarynach – to pierwsze w woj, Warmińsko-Mazurskim międzygminne schronisko. 
                Dziewięć Gmin: Gietrzwałd, Stawiguda, Jonkowo, Świątki, Dobre Miasto , Olsztynek, Purda, Barczewo, Dywity – 
                te gminy postanowiły konstruktywnie zareagować na szeroko rozumiany problem bezdomności zwierząt, budując obiekt w Tomarynach, 
                który przyjmuje bezdomne w wyniku różnych okoliczności psy/suczki. Obiekt został otwarty w grudniu 2013 r.
            </p>
            <p>
                Schronisko poza opieką, poszukiwaniem domów i promocją adopcji – wykonuje również obligatoryjne zabiegi kastracji 
                i sterylizacji przebywających w nim psów/suczek – celem ograniczenia populacji zwierząt jako element realizacji 
                Programu Walki z Bezdomnością Zwierząt realizowanego w w/w gminach. Warto również dodać, że psiaki dowożone są do nowych, 
                sprawdzonych i przede wszystkim dobrych domów na terenie całego kraju i to w dodatku za darmo.
            </p>
            <p>
                Zapraszamy do odwiedzenia fanpage’a schroniska oraz strony adopcyjnej w celu śledzenia prężnych działań pracowników schroniska
                i grupy wolontariuszy na rzecz psiaków-tomaryniaków.
            </p>
        </div>
    </div>
    @extends('layouts.footer')
</body></html>
