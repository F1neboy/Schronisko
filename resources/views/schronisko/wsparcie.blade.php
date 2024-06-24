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
            background-image: url(img/wsp-back.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position-y: 10%;
            background-position-x: center;
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
            padding-bottom: 1%;
        }
    </style>
</head>

<body>
    @extends('layouts.navbar')
    <div class="container-fluid cont-fl">
        <h2><p>Wsparcie</p></h2>
    </div>
    <div class="container-sm ">
        <div class="row">
            <h3>Wsparcie</h3>
            <hr>
            <p></p>
            <h3>Wolontariat</h3>
            <hr>
            <p>
            Wszystkich chętnych bez względu na wiek i czas jaki możecie poświęcić zapraszamy na wolontariat. Pomagać możesz na różne sposoby:
            <ul>
                <li>wyprowadzać psy, pielęgnować je i socjalizować,</li>
                <li>zbierać karmę i akcesoria dla psów oraz koce, ręczniki itp.</li>
                <li>szukanie domów dla psiaków poprzez znajomych, plakaty, Internet (robienie ogłoszeń na portalach internetowych oraz na Fb, itp.),</li>
                <li>wizyty przed i po adopcyjne,</li>
                <li>transport psiaków do nowych domów,</li>
                <li>dając dla psa dom tymczasowy,</li>
                <li>robienie zdjęć ogłoszeniowych naszym psom, dobre zdjęcia zwiększają szanse na adopcje,</li>
                <li>pomoc w organizacji koncertów, festynów, wystaw i innych działań na rzecz poprawy dobrostanu zwierząt,</li>
                <li>udział w naszych projektach,</li>
                <li>będziesz miał możliwość przy naszym wsparciu koordynacji i realizacji własnych pomysłów na rzecz bezdomnych psów w schronisku.</li> 
            </ul>
            </p>
        </div>
    </div>
    @extends('layouts.footer')
</body>
</html>
