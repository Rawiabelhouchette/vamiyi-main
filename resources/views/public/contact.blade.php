@extends('layout.public.app')

@section('css')
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
    <section class="title-transparent page-title" style="background:url(assets_client/img/banner/image-4.jpg);">
        <div class="container">
            <div class="title-content">
                <h1>Vamiyi</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Contactez-nous</span>
                </div>
            </div>
        </div>
    </section>

    <div class="clearfix"></div>

    <section class="padd-0">
        <div class="container">
            <div class="col-md-10 col-md-offset-1 col-sm-12 translateY-60">
                <div class="col-md-6 col-sm-6">
                    <div class="detail-wrapper text-center padd-top-40 mrg-bot-10 padd-bot-40 light-bg">
                        <i class="theme-cl font-30 ti-location-pin"></i>
                        <h4>Bureau du Togo</h4>
                        Lomé-Adidogomé
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="detail-wrapper text-center padd-top-40 mrg-bot-10 padd-bot-40 light-bg">
                        <i class="theme-cl font-30 ti-email"></i>
                        <h4>contact@numrod.fr</h4>
                        contact@numrod.fr
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="padd-top-0">
        <div class="container">
            <div class="col-md-6 col-sm-6">
                <form action="{{ route('contact-us') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Nom:</label>
                        <input class="form-control" name="name" type="text" placeholder="Nom" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input class="form-control" name="email" type="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label>Objet:</label>
                        <input class="form-control" name="objet" type="text" placeholder="Objet" required>
                    </div>
                    <div class="form-group">
                        <label>Message:</label>
                        <textarea class="form-control" name="message" placeholder="Message" required></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn theme-btn" name="submit">Envoyer</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-sm-6">
                <div id="singleMap" style="position: relative; overflow: hidden;">
                    <div id="map" style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        var mymap = L.map('map').setView([8.6195, 0.8248], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 15
        }).addTo(mymap);

        var marker;

        var lon = '0.72143577039242';
        var lat = '9.6757766943938';
        if (marker) {
            mymap.removeLayer(marker);
        }

        marker = L.marker([lat, lon]).addTo(mymap);
        mymap.setView([lat, lon], 8);
    </script>
@endsection
