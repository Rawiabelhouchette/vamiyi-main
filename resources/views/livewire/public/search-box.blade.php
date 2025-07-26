<div>
    @php
        $defaultColor = '#ff3a72';
    @endphp

    <!-- ================ Start Page Title ======================= -->
    <section class="title-transparent page-title" style="background:url(assets_client/img/banner/image-1.jpg);">
        <div class="container">
            <div class="title-content">
                <h1>Vamiyi</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    @if ($detail)
                        {{-- <a href="#" style="color: white;" onclick="event.preventDefault(); history.back();">Résultat</a> --}}
                        <span class="current">Résultat</span>
                        <span class="gt3_breadcrumb_divider"></span>
                        <span class="current">Détail</span>
                    @else
                        <span class="current">Résultat</span>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- ================ End Page Title ======================= -->

    <!-- ================ Listing In Grid Style ======================= -->
    <section class="padd-top-0 padd-bot-0 overlap">
        <div class="container">
            <!-- Searc Filter -->
            <div class="row">
                <div class="white-box white-shadow padd-top-30 padd-bot-30 translateY-60">
                    <h3 class="text-center">Recherche</h3>
                    <form class="form-verticle" method="GET" action="{{ route('search') }}">
                        <input type="hidden" value="1" name="form_request">
                        <div class="col-md-3 col-sm-3 no-padd">
                            <input type="text" class="form-control left-radius" placeholder="Mot clé .." name="key" value="{{ $key }}">
                        </div>

                        <div class="col-md-4 col-sm-4 no-padd">
                            <input id="myInput" type="text" class="form-control" placeholder="Localisation .." name="location" value="{{ $location }}">
                            <div id="autocomplete-results" class="autocomplete-items"></div>
                        </div>

                        <div class="col-md-3 col-sm-3 no-padd">
                            <select class="form-control" id="search-type-input" name="type[]" value="{{ $type }}">
                                <option value="" selected>Tous les types d'annonce</option>
                                @foreach ($typeAnnonce as $annonce)
                                    <option value="{{ $annonce }}" {{ $annonce == $type ? 'selected' : '' }} style="hover: {{ $defaultColor }};">{{ $annonce }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-2 no-padd">
                            <button type="submit" class="btn theme-btn normal-height full-width">Rechercher</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

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
        }

        .autocomplete-items div:hover {
            background-color: #f6f6f6;
        }

        .autocomplete-items div:first-child {
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            border-top: 1px solid #d4d4d4;
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
    @endpush
</div>
