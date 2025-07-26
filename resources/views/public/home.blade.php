@extends('layout.public.app')

@section('css')
    <style>
        #banner {
            transition: background 2s ease-in-out;
        }
    </style>
@endsection

@section('content')

    @include('components.default-value')

    @php
        $defaultColor = '#ff3a72';
    @endphp

    <!-- Main Banner Section Start -->
    <div class="banner dark-opacity" id="banner" data-overlay="8" style="background-image:url(assets_client/img/banner/image-1.jpg);">
        <div class="container">
            <div class="banner-caption">
                <div class="col-md-12 col-sm-12 banner-text">
                    <h1 style="font-size: 50px; ">Vamiyi, l'aventure commence ici</h1>
                    <p>Explorez les meilleurs endroits, des restaurants et plus encore...</p>
                    <form class="form-verticle" method="GET" action="{{ route('search') }}">
                        <input name="form_request" type="hidden" value="1">
                        <div class="col-md-4 col-sm-4 no-padd">
                            <i class="banner-icon icon-pencil"></i>
                            <input class="form-control left-radius right-br" name="key" type="text" placeholder="Mot clé...">
                        </div>
                        <div class="col-md-3 col-sm-3 no-padd">
                            <div class="form-box">
                                <i class="banner-icon icon-map-pin"></i>
                                <input class="form-control right-br" id="myInput" name="location" type="text" placeholder="Localisation...">
                                <div class="autocomplete-items" id="autocomplete-results"></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 no-padd">
                            <div class="form-box">
                                <i class="banner-icon icon-layers"></i>
                                <select class="form-control" name="type[]">
                                    <option class="chosen-select" data-placeholder="{{ __('Tous les types d\'annonce') }}" value="" selected>{{ __('Tous les type d\'annonce') }}</option>
                                    @foreach ($typeAnnonce as $annonce)
                                        <option value="{{ $annonce }}">{{ $annonce }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-3 no-padd">
                            <div class="form-box">
                                <button class="btn theme-btn btn-default" type="submit">
                                    {{-- <i class="ti-search"></i> --}}
                                    {{ __('Rechercher') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- <div class="popular-categories">
                        <ul class="popular-categories-list">
                            @foreach ($listAnnonce as $key => $annonce)
                                <li>
                                    <a href="{{ route('search.key.type', ['', $annonce->nom]) }}">
                                        <div class="pc-box">
                                            <i class="{{ $annonce->icon }} {{ $annonce->color }}"></i>
                                            <p>{{ $annonce->nom }} <br></p>
                                        </div><br>
                                    </a>
                                </li>
                                @if ($key >= 5)
                                @break
                            @endif
                        @endforeach
                    </ul>
                </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <!-- Main Banner Section End -->

    <!-- Listings Section -->
    <section class="sec-bt">
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="heading">
                        {{-- <h2>Top & Popular <span>Listings</span></h2> --}}
                        <h2>Top & Populaire <span>Annonces</span></h2>
                        <p>Explorez les meilleurs endroits, des restaurants , des hôtels, des auberges et plus encore...</p>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Single List -->
                @foreach ($annonces as $annonce)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="property_item classical-list">
                            <div class="image" style="height: 200px important">
                                <a class="listing-thumb" href="{{ route('show', $annonce->slug) }}">
                                    @if ($annonce->image)
                                        <img class="img-responsive" src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" alt="latest property" style="object-fit: cover; object-position: center; width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                    @else
                                        <img class="img-responsive" src="http://via.placeholder.com/1200x800" alt="latest property">
                                    @endif
                                </a>
                                {{-- <div class="listing-price-info">
                                <span class="pricetag">{{ $annonce->type }}</span>
                            </div> --}}
                            </div>

                            <div class="proerty_content">
                                <div class="author-avater">
                                    @if ($annonce->image)
                                        <img class="author-avater-img" src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" alt="latest property" style="width: 70px; height: 70px; object-fit: cover; object-position: center;">
                                    @else
                                        <img class="author-avater-img" src="http://via.placeholder.com/120x120" alt="">
                                    @endif
                                </div>
                                <div class="proerty_text">
                                    <h3 class="captlize">
                                        <a href="{{ route('show', $annonce->slug) }}">
                                            {{ $annonce->titre }}
                                        </a>
                                        {{-- <span class="veryfied-author"></span> --}}
                                    </h3>
                                </div>
                                <p class="property_add" style="color: {{ $defaultColor }};">{{ $annonce->type }}</p>
                                <div class="property_meta">
                                    <div class="list-fx-features">
                                        <div class="listing-card-info-icon">
                                            <span class="inc-fleat inc-add mrg-0">
                                                {{ $annonce->entreprise->adresse_complete }}
                                            </span>
                                        </div>
                                        <div class="listing-card-info-icon">
                                            <span class="inc-fleat inc-call mrg-0">
                                                <a href="tel:{{ $annonce->entreprise->quartier->ville->pays->indicatif }}{{ str_replace(' ', '', $annonce->entreprise->telephone) }}">
                                                    {{ $annonce->entreprise->quartier->ville->pays->indicatif }} {{ $annonce->entreprise->telephone }}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="listing-footer-info">
                                <div class="listing-cat">
                                    <a class=" cl-1" href="{{ route('entreprise.show', $annonce->entreprise->slug) }}">
                                        <span class="more-cat mrg-l-0" style="">
                                            <i class="fas fa-building"></i>
                                        </span> &nbsp;
                                        {{ $annonce->entreprise->nom }}
                                    </a>
                                </div>
                                @if ($annonce->entreprise->est_ouverte)
                                    <span class="place-status">Ouvert</span>
                                @else
                                    <span class="place-status closed">Fermée</span>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- End Listings Section -->

    <!-- Category Section -->
    <section class="bg-image" data-overlay="6" style="background:url(assets_client/img/image-stat.JPEG);">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="heading light">
                        <h2>Les types <span>d'annonce </span></h2>
                        <p>Les types d'annonce que les gens visitent le plus, les plus populaires</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="category-slide">
                    @foreach ($listAnnonce as $list)
                        <div class="list-slide-box">
                            <div class="category-full-widget">
                                <div class="category-widget-bg" style="background-image: url({{ $list->image }});">
                                    <i class="bg-{{ $list->bg }} cat-icon {{ $list->icon }}" aria-hidden="true"></i>
                                </div>
                                <div class="cat-box-name">
                                    <h4>{{ $list->libelle }}</h4>
                                    <a class="btn-btn-wrowse" href="{{ route('search.key.type', ['', $list->nom]) }}">Parcourir</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
    <!-- End Category Section -->

    <!-- Top Places Listing -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="heading">
                        <h2>Les types d'annonce</h2>
                        <p>La liste des types d'annonce</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($statsAnnonce as $key => $stat)
                    @if ($key > 5)
                    @break
                @endif
                <div class="col-md-{{ $key % 4 == 0 || $key % 4 == 3 ? '4' : '8' }} col-sm-{{ $key % 4 == 0 || $key % 4 == 3 ? '5' : '7' }}">
                    <a class="place-box" href="{{ route('search.key.type', ['', $stat->type]) }}">
                        <span class="listing-count">
                            <strong> {{ $stat->count }} Annonce(s) </strong>
                        </span>
                        <div class="place-box-content">
                            <h4>{{ $stat->type }}</h4>
                            <span>Voir les annonces</span>
                        </div>
                        @foreach ($listAnnonce as $type)
                            @if (Str::slug($type->nom) == Str::slug($stat->type) || Str::slug($type->libelle) == Str::slug($stat->type))
                                <div class="place-box-bg" style="background-image: url({{ $type->image }});"></div>
                            @endif
                        @endforeach
                    </a>
                </div>
            @empty
                <div class="col-md-12">
                    <p class="text-center">Aucune annonce n'est disponible pour le moment</p>
                </div>
            @endforelse
        </div>

</section>

<section class="company-state theme-overlap" style="background:url(assets_client/img/image-stat.JPEG);">
    <div class="container-fluid">
        <div class="col-md-3 col-sm-6">
            <div class="work-count">
                <span class="theme-cl icon fa fa-briefcase"></span>
                <span class="counter">200</span> <span class="counter-incr">+</span>
                <p>Annonce</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="work-count">
                <span class="theme-cl icon ti-layers"></span>
                <span class="counter">307</span> <span class="counter-incr">+</span>
                <p>Type annonce</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="work-count">
                <span class="theme-cl icon fa fa-building"></span>
                <span class="counter">700</span> <span class="counter-incr">+</span>
                <p>Entreprise</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="work-count">
                <span class="theme-cl icon ti-user"></span>
                <span class="counter">770</span> <span class="counter-incr">+</span>
                <p>Utilisateur</p>
            </div>
        </div>
    </div>

    <style>
        .autocomplete {
            position: relative;
            display: inline-block;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            top: 100%;
            left: 0;
            right: 0;
            border-radius: 5px;
            margin-top: 5px;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
            text-align: left;
            /*  */
            color: #90969e;
        }

        .autocomplete-items div:hover {
            background-color: #f6f6f6;
            /* background-color: #ff3a72; */
            /* color: #fff; */
            color: #90969e;
        }

        .autocomplete-items div:first-child {
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .autocomplete-items div:last-child {
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
    </style>

    @push('scripts')
        <script>
            let countries = @json($quartiers);
            let myInput = document.getElementById('myInput');

            myInput.addEventListener('focus', function(e) {
                let a, b, val = this.value;
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                this.parentNode.appendChild(a);
                if (!val) {
                    for (let i = 0; i < countries.length; i++) {
                        b = document.createElement("DIV");
                        b.innerHTML = '<i class="icon-map-pin"></i>&nbsp;&nbsp;' + countries[i];
                        b.innerHTML += "<input type='hidden' value='" + countries[i] + "'>";
                        b.addEventListener("click", function(e) {
                            document.getElementById('myInput').value = this.getElementsByTagName("input")[0].value;
                            closeAllLists();
                        });
                        a.appendChild(b);

                    }
                    return;

                }

                for (let i = 0; i < countries.length; i++) {
                    let country = normalize(countries[i]).toUpperCase();
                    let searchVal = normalize(val).toUpperCase();

                    if (country.includes(searchVal)) {
                        let startIdx = country.indexOf(searchVal);
                        let endIdx = startIdx + searchVal.length;

                        b = document.createElement("DIV");
                        b.innerHTML = '<i class="icon-map-pin"></i>&nbsp;&nbsp;' + countries[i].substr(0, startIdx) +
                            "<strong>" + countries[i].substr(startIdx, searchVal.length) + "</strong>" +
                            countries[i].substr(endIdx);
                        b.innerHTML += "<input type='hidden' value='" + countries[i] + "'>";
                        b.addEventListener("click", function(e) {
                            document.getElementById('myInput').value = this.getElementsByTagName("input")[0].value;
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });


            myInput.addEventListener('input', function(e) {
                let a, b, val = this.value;
                closeAllLists();
                if (!val) {
                    return false;
                }
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                this.parentNode.appendChild(a);
                for (let i = 0; i < countries.length; i++) {
                    let country = normalize(countries[i]).toUpperCase();
                    let searchVal = normalize(val).toUpperCase();

                    if (country.includes(searchVal)) {
                        let startIdx = country.indexOf(searchVal);
                        let endIdx = startIdx + searchVal.length;

                        b = document.createElement("DIV");
                        b.innerHTML = '<i class="icon-map-pin"></i>&nbsp;&nbsp;' + countries[i].substr(0, startIdx) +
                            "<strong>" + countries[i].substr(startIdx, searchVal.length) + "</strong>" +
                            countries[i].substr(endIdx);
                        b.innerHTML += "<input type='hidden' value='" + countries[i] + "'>";
                        b.addEventListener("click", function(e) {
                            document.getElementById('myInput').value = this.getElementsByTagName("input")[0].value;
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });

            function normalize(str) {
                return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            }

            function closeAllLists(elmnt) {
                let x = document.getElementsByClassName("autocomplete-items");
                for (let i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != document.getElementById('myInput')) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }

            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('select').niceSelect();
            });
        </script>
    @endpush
</section>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        var images = ['image-1.jpg', 'image-2.jpg', 'image-3.JPEG', 'image-4.jpg'];
        var index = 0;
        var interval;

        var banner = document.getElementById('banner');
        var form = document.querySelector('.form-verticle');

        // Function to change image
        function changeImage() {
            index = (index + 1) % images.length;
            banner.style.backgroundImage = "url('assets_client/img/banner/" + images[index] + "')";
        }

        // Set image change interval
        function setImageChangeInterval() {
            interval = setInterval(changeImage, 5000);
        }

        setImageChangeInterval();

        // Change image on click
        banner.addEventListener('click', function(event) {
            if (event.target === form || form.contains(event.target)) {
                // If the click event originated from the form, stop the event propagation
                // event.stopPropagation();
            } else {
                clearInterval(interval); // Clear the interval
                changeImage(); // Change the image immediately
                setImageChangeInterval(); // Set the interval again
            }
        });
    });
</script>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('select').niceSelect();
    });
</script>
@endsection
