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
            background-image: url(img/adop-back.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position-y: 50%;
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
        <h2><p>O Adopcji</p></h2>
    </div>
    <div class="container-sm ">
        <div class="row">
            <p>
                Dbając o dobro naszych psów oraz domów chętnych do adopcji, w naszym schronisku obowiązuje procedura przed adopcyjna polegająca na :
            </p>
            <p>    
                Po kontakcie telefonicznym ( NIE ODPOWIADAMY NA SMS-Y) i wstępnej weryfikacji na podstawie rozmowy przesyłana jest ankieta 
                przed adopcyjna na adres mailowy wysłany SMS-em wraz z imieniem psa na numer podany w ogłoszeni. Następnie, jeżeli ankieta 
                zostanie rozpatrzona pozytywnie drugim krokiem jest :
                Wizyta przed adopcyjna przeprowadzana przez osobę lokalną z ogólno-polskiej listy wizytatorów
                Wizytator ostatecznie decyduje o adopcji. Po otrzymaniu pozytywnej odpowiedzi od wizytatora dowozimy psiaki w całej Polsce.
                 Dom adoptujący podpisuje umowę adopcyjna oraz otrzymuje książeczkę zdrowia psa.
                Adopcja nic nie kosztuje! Celem procedury jest przede wszystkim sprawdzenie czy przyszłe domy mają prawdziwą empatie do zwierząt.
                 Pomimo empatii do zwierząt nie damy psiaka do adopcji jeżeli jest duże prawdopodobieństwo ze dany dom z tym psem sobie nie poradzi.
            </p>
             <p>
                Nie wydajemy psów do kojców, a tym bardziej na łańcuchy!!  W większości nie wydajemy psów na zewnątrz. Jedynie w przypadku, 
                kiedy pies się do tego nadaje – posiada odpowiednie cechy charakteru oraz odpowiednia sierść lub taki będzie jego wybór.
            </p>
            <p>
                Przy adopcji musimy pamiętać nie tylko o zaspokojeniu swoich potrzeb, ale przede wszystkim o potrzebach emocjonalnych psa, 
                który tak naprawdę całe swoje życie jest na poziomie 3-letniego dziecka i tak samo odbiera WSZYSTKIE EMOCJE.
            </p>
            <p>
                Wybór psa ze względu na wygląd lub rasę, czy panujące trendy nie zawsze jest odpowiedni. Psiaka powinniśmy dobierać odpowiednio 
                do swojego charakteru i trybu życia. Jeżeli chodzi o daną rasę należy posiadać wiedzę na temat tej rasy. Każdy chętny do adopcji 
                psa ze schroniska powinien się do niej odpowiednio przygotować – polecamy książkę <i>‘OKIEM PSA’ (John Fisher)</i>, nawet dla tych, 
                którzy już maja doświadczenie z psami. Prosto i przejrzyście napisana będzie wspaniałą lekturą dla każdego, kto pragnie mieć psa, 
                a jej trafne, ponadczasowe przesłanie potrafi wykorzystać każdy.
            </p>
            <p>
                Odpowiednie przygotowanie pozwoli na unikniecie problemów oraz rozczarowania adopcja. Nie jesteśmy w stanie przewidzieć, jak pies 
                zachowa się w nowym środowisku – to od wiedzy adoptujących, ich odpowiedzialności i cierpliwości zależy przyszłość psa w nowym miejscu 
                – tu ponownie zachęcamy do lektury książki <i>‘OKIEM PSA’ (John Fisher)</i>. W większości przypadków nie znamy przeszłości psów, który do nas 
                trafiły, możemy jedynie przybliżyć ich charakter oraz temperament i przekazać wiedzę na temat ich i ich zachowania w warunkach schroniskowych.
            </p>
            <p>
                Zadaniem nowych domów jest socjalizacja psa w nowym środowisku. Powinniśmy być przygotowani na wszystko. W razie problemów prosimy skontaktować się lub skonsultować swoje działania z lokalnym behawiorystą, ponieważ nieodpowiednie zachowanie może mieć odwrotny skutek. Dla naszych psiaków szukamy NAJLEPSZYCH domów, jednak też nie jesteśmy w stanie nigdy w 100% zagwarantować i przewidzieć, że to będzie ten dom do końca życia, mimo to dokładamy wszelkich starań, żeby zwiększyć  prawdopodobieństwo szczęśliwej adopcji.
            </p>
            <p>
                <b>Jeżeli akceptujesz naszą procedurę i jesteś gotowy do adoptowania psa zadzwoń : 606507829. One czekają właśnie na Ciebie!</b>
            </p>
        </div>
    </div>
    @extends('layouts.footer')
</body>
</html>
