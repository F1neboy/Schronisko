
<div class="header fixed-top">
    <nav class="navbar navbar-light navbar-expand-lg bg-faded justify-content-center">
        <div class="container">
            <a href="/" class="navbar-brand d-flex me-auto"><img src="{{asset('img/logo-2.png')}}" alt="logo"><span id="brand-name">  | Schronisko w Tomarynach</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsingNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse w-100 text-center" id="collapsingNavbar">
                <ul class="navbar-nav w-100 justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Strona główna</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('o-nas*')||Request::is('kontakt*')||Request::is('wsparcie*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">O schronisku</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/o-nas">O nas</a></li>
                            <li><a class="dropdown-item" href="/kontakt">Kontakt/dojazd</a></li>
                            <li><a class="dropdown-item" href="/wsparcie">Wsparcie</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('aktualnosci*') ? 'active' : '' }}" href="/aktualnosci">Aktualności</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('o-adopcji*') ? 'active' : '' }}" href="/o-adopcji">O adopcji</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('adopcja*')||Request::is('przybyle*')||Request::is('poszukiwane*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">Zwierzęta</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/adopcja">Psy do adopcji</a></li>
                            <li><a class="dropdown-item" href="/przybyle">Przybyłe do schroniska</a></li>
                            <li><a class="dropdown-item" href="/poszukiwane">Poszukiwany/Znaleziony</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('wydarzenia*') ? 'active' : '' }}" href="/wydarzenia">Wydarzenia</a>
                    </li>
                    @if(Session::has('user'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('adminPanel*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown">Admin Panel</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/adminPanel">Admin Panel</a></li>
                            <li><a class="dropdown-item" href="/logout">Wyloguj</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
