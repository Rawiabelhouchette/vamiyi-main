<!-- /. NAV TOP  -->
<nav class="navbar navbar-side">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li>
                <a href="{{ route('accueil') }}" style="padding-top: 25px;"><i class="fa fa-home" aria-hidden="true"></i>Revenir à l'accueil</a>
            </li>

            @if (auth()->user()->hasRole('Administrateur') || auth()->user()->hasRole('Professionnel'))
                <li class="@yield('dashboard')">
                    <a href="{{ route('home') }}"><i class="fa fa-dashboard" aria-hidden="true"></i>Tableau de bord</a>
                </li>
            @endif

            @if (auth()->user()->hasRole('Administrateur'))
                <li class="@yield('reference')">
                    <a href="javascript:void(0)"><i class="fa fa-cog" aria-hidden="true"></i>Référence <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('references.nom.add') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Nom
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('references.create') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Valeur
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('references.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Rechercher
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="@yield('localisation')">
                    <a href="javascript:void(0)"><i class="fa fa-map" aria-hidden="true"></i>Localisation <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('pays.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Pays
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('villes.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Ville
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('quartiers.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Quartier
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('localisations') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Rechercher
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="@yield('compte')">
                    <a href="javascript:void(0)"><i class="fa fa-briefcase" aria-hidden="true"></i>Compte <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('users.create') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Ajouter
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Rechercher
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->user()->hasRole('Administrateur') || auth()->user()->hasRole('Professionnel'))
                <li class="@yield('entreprise')">
                    <a href="javascript:void(0)"><i class="fa fa-city" aria-hidden="true"></i>Entreprise <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        @if (auth()->user()->hasRole('Administrateur'))
                            <li>
                                <a href="{{ route('entreprises.create') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                    Ajouter
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('entreprises.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Rechercher
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="@yield('annonce')">
                    <a href="javascript:void(0)"><i class="fa fa-clone" aria-hidden="true"></i>Gestion annonce<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('annonces.create') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Ajouter
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('annonces.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Rechercher
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="@yield('abonnement')">
                    <a href="javascript:void(0)"><i class="fa fa-credit-card" aria-hidden="true"></i>Abonnement<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('abonnements.create') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Ajouter
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('abonnements.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Rechercher
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->user()->hasRole('Professionnel'))
                <li class="@yield('entreprise')">
                    <a href="{{ route('entreprises.show', auth()->user()->entreprises->first()->id) }}"><i class="fa fa-building" aria-hidden="true"></i>Entreprise</a>
                </li>

                <li class="@yield('abonnement')">
                    <a href="javascript:void(0)"><i class="fa fa-credit-card" aria-hidden="true"></i>Abonnement<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('abonnements.create') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Ajouter
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('abonnements.index') }}"><i class="fa fa-circle-o-notch" style="margin-right: 15px;font-size: 16px;"></i>
                                Rechercher
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="@yield('profil')">
                <a href="{{ route('accounts.index') }}"><i class="fa fa-user" aria-hidden="true"></i>Mon Profil</a>
            </li>

            {{-- favoris --}}
            <li class="@yield('favoris')">
                <a href="{{ route('accounts.favorite.index') }}"><i class="fa fa-star" aria-hidden="true"></i>Favoris</a>
            </li>

            {{-- comment --}}
            <li class="@yield('comment')">
                <a href="{{ route('accounts.comment.index') }}"><i class="fa fa-comment" aria-hidden="true"></i>Commentaires</a>
            </li>

            <br>
            <br>
        </ul>
    </div>

</nav>
<!-- /. NAV SIDE  -->
