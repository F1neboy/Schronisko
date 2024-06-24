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
            background-image: url(img/kontakt-back.jpg);
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
            padding-bottom: 1%;
        }
        p>span{
            font-weight: 900;
        }
    </style>
</head>

<body>
    @extends('layouts.navbar')
    <div class="container-fluid cont-fl">
        <h2><p>Kontakt/Dojazd</p></h2>
    </div>
    <div class="container-sm">
        <div class="row">
                    <h3>Kontakt</h3>
                    <hr>
                    <div class="text-center">
                        <p><span> Nr telefonu (schronisko):</span> +48 534 204 420 <i class="fa-solid fa-phone-flip"></i></p>
                        <p><span> Nr telefonu (adopcje):</span> +48 606 507 829 <i class="fa-solid fa-phone-flip"></i></p>
                        <p><span> Email:</span> sdzbiesal@gmail.com <i class="fa-regular fa-envelope"></i></p>
                        <p><span>Adres:</span> Tomaryny 31, 11-036 Tomaryny <i class="fa fa-map-marker"></i></p>
                        <p><b>Godziny otwarcia:</b></p>
                        <p>Poniedziałek 08:00 - 16:00</p>
                        <p>Wtorek 08:00 - 16:00</p>
                        <p>Środa 08:00 - 16:00</p>
                        <p>Czwartek 08:00 - 16:00</p>
                        <p>Piątek 08:00 - 16:00</p>
                        <p>Sobota 08:00 - 16:00</p>
                        <p>Niedziela 08:00 - 16:00</p>
                    </div>
                    <h3>Dojazd</h3>
                    <hr>
                    <p style="text-align: center">Dojazd do nas jest nieco utrudniony</p>
                    <p style="text-align: center">Najłatwiejszą formą jest dojazd samochodem, ale istnieje również możliwość dojazdu pociągiem lini kolejowych Polregio w kierunku Ostróda, Iława, Toruń. Stacja docelowa to: Biesal, następnie 10 minut spacerem do naszego schroniska. </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2317.241737512177!2d20.203455
                        11582126!3d53.71735528005856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471d7eeffe4f3af5%3A0x288dad9d982b8ba3!2sMi%C4%99dzygminne%20
                        Schronisko%20dla%20Bezdomnych%20Zwierz%C4%85t!5e1!3m2!1spl!2spl!4v1652089636124!5m2!1spl!2spl" width="100%" height="450" style="border:0;" 
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    @extends('layouts.footer')
</body>
</html>
