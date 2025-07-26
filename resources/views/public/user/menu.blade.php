@props(['category'])
{{-- 
    0: Favoris
    1: Commentaires
    2: Tableau de bord
    3: Annonces
    4: Entreprise
    5: Abonnements

    
--}}

<div class="col-md-3 col-sm-12">
    <div class="sidebar">
        <!-- Start: Search By Price -->
        <div class="widget-boxed facette-color" style="padding-bottom: 0px;">
            <div class="widget-boxed-body padd-top-10 padd-bot-0">
                <div class="side-list">
                    <ul class="price-range">
                        {{-- @if (auth()->user()->hasRole('Professionnel'))
                            <li>
                                <a href="{{ route('home') }}">
                                    <span class="custom-checkbox d-block @if ($category == 3) theme-cl @endif" style="font-size: 18px;">
                                        <i class="fa-solid fa-tachometer @if ($category == 3) theme-cl @endif"></i> &nbsp;
                                        Tableau de bord
                                    </span>
                                </a>
                            </li>
                        @endif --}}

                        <li>
                            <a href="{{ route('accounts.index') }}">
                                <span class="custom-checkbox d-block @if ($category == 0) theme-cl @endif" style="font-size: 18px;">
                                    <i class="fa-solid fa-user @if ($category == 0) theme-cl @endif"></i> &nbsp;
                                    Profil
                                </span>
                            </a>
                        </li>

                        {{-- @if (auth()->user()->hasRole('Professionnel'))
                            <li>
                                <a href="{{ route('entreprises.index') }}">
                                    <span class="custom-checkbox d-block" style="font-size: 18px;">
                                        <i class="fa-solid fa-cog"></i> &nbsp;
                                        Entreprise
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('annonces.index') }}">
                                    <span class="custom-checkbox d-block @if ($category == 4) theme-cl @endif" style="font-size: 18px;">
                                        <i class="fa-solid fa-ad @if ($category == 4) theme-cl @endif"></i> &nbsp;
                                        Annonces
                                    </span>
                                </a>
                            </li>
                        @endif --}}

                        <li>
                            <a href="{{ route('accounts.favorite.index') }}">
                                <span class="custom-checkbox d-block @if ($category == 1) theme-cl @endif" style="font-size: 18px;">
                                    <i class="fa-solid fa-star @if ($category == 1) theme-cl @endif"></i> &nbsp;
                                    Favoris
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('accounts.comment.index') }}">
                                <span class="custom-checkbox d-block @if ($category == 2) theme-cl @endif" style="font-size: 18px;">
                                    <i class="fa-solid fa-comment @if ($category == 2) theme-cl @endif"></i> &nbsp;
                                    Commentaires
                                </span>
                            </a>
                        </li>

                        {{-- @if (auth()->user()->hasRole('Professionnel'))
                            <li>
                                <a href="{{ route('subscriptions.index') }}">
                                    <span class="custom-checkbox d-block @if ($category == 5) theme-cl @endif" style="font-size: 18px;">
                                        <i class="fa-solid fa-briefcase @if ($category == 5) theme-cl @endif"></i> &nbsp;
                                        Abonnements
                                    </span>
                                </a>
                            </li>
                        @endif --}}

                        {{-- Administration --}}
                        @if (auth()->user()->hasRole('Professionnel'))
                            <li>
                                <a href="{{ route('home') }}" target="_blank">
                                    <span class="custom-checkbox d-block" style="font-size: 18px;">
                                        <i class="fa-solid fa-cog"></i> &nbsp;
                                        Administration
                                    </span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
