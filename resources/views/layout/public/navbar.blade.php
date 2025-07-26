@props(['active' => null])

<nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav">
    <div class="container-fluid">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
            <i class="ti-align-left"></i>
        </button>

        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('accueil') }}">
                @if ($active == 'login')
                    <img src="{{ asset('assets/img/logo-vamiyi-by-numrod.png') }}" class="logo logo-display" alt="">
                @else
                    <img src="{{ asset('assets/img/logo-vamiyi-by-numrod-white.png') }}" class="logo logo-display" alt="">
                @endif
                <img src="{{ asset('assets/img/logo-vamiyi-by-numrod.png') }}" class="logo logo-scrolled" alt="">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="navbar-menu" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                <li>
                    <a href="{{ route('accueil') }}">
                        Accueil
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">
                        Contactez-nous
                    </a>
                </li>
                @if (auth()->check() && auth()->user()->hasRole('Administrateur'))
                    <li>
                        <a href="{{ route('home') }}" target="_blank">
                            Accès professionnel
                        </a>
                    </li>
                @endif
                @if (auth()->check() && auth()->user()->hasRole('Usager'))
                    <li>
                        <a href="{{ route('pricing') }}">
                            Déposer une annonce
                        </a>
                    </li>
                @endif
            </ul>
            {{-- if user is not connected or hasrole Administrateur --}}
            @if (!auth()->check())
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="no-pd">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#signin" class="addlist" onclick="$('#share').hide()">
                            <i class="ti-user" aria-hidden="true"></i>Connexion
                        </a>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="no-pd dropdown">
                        <a href="{{ route('home') }}" class="addlist">
                            <img src="{{ asset('assets_client/img/default-user.svg') }}" class="img-responsive img-circle avater-img" width="50px" height="50px" alt="">
                            <strong id="navbar_username">{{ auth()->user()->nom }} {{ auth()->user()->prenom }}</strong>
                        </a>
                        <ul class="dropdown-menu animated navbar-left fadeOutUp" style="display: none; opacity: 1;">
                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="fa fa-user" aria-hidden="true"></i> &nbsp;
                                    Mon compte
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="fa fa-power-off" aria-hidden="true"></i> &nbsp;
                                    Déconnexion
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endif
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>
