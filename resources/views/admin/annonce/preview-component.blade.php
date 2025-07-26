@props(['annonce'])

<style>
    .tp-author-basic-info {
        margin: 30px 0 0 0;
        padding: 0 25px;
        border-top: 1px solid #ebedf1;
    }

    .tp-author-basic-info ul {
        width: 100%;
        display: table;
    }

    .tp-author-basic-info li {
        list-style: none;
        display: inline-block;
        width: 33.333333%;
        padding: 15px 0 10px;
    }

    .tp-author-basic-info li strong {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #384454;
    }

    .listing-price-info {
        position: absolute;
        top: 20px;
        left: 20px;
        display: inline-block;
        border-radius: 50px;
        font-size: 14px;
    }

    .listing-price-info span {
        display: inline-block;
        /* background: #ffffff; */
        background: #ff3a72;
        color: #ffffff !important;
        padding: 4px 18px;
        border-radius: 50px;
        font-size: 14px;
        margin-right: 15px;
        color: #505667;
        box-shadow: 0px 0px 0px 5px rgba(255, 255, 255, 0.2);
    }

    .listing-location {
        height: 50px !important;
    }

    .img-responsive {
        object-fit: cover;
        object-position: center;
        width: 100%;
        height: 100%;
    }
</style>

<div class="row bott-wid">

    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Prévisualisation de l'annonce</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="listing-shot grid-style">
            <div class="listing-shot-img">
                <a href="{{ route('show', $annonce->slug) }}" target="_blank">
                    @if ($annonce->image)
                        <img class="img-responsive" src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" alt="" style="object-fit: cover;">
                    @else
                        <img class="img-responsive" src="http://via.placeholder.com/800x800" alt="">
                    @endif
                </a>
            </div>
            <div class="listing-shot-caption">
                <a href="{{ route('show', $annonce->slug) }}">
                    <h4 class="theme-cl-blue">{{ $annonce->titre }}</h4>
                    <p class="listing-location">{{ $annonce->description_courte == '' ? 'Pas de description' : $annonce->description_courte }}</p>
                </a>
                @if (Auth::check())
                    @if ($annonce->est_favoris)
                        <a href="javascript:void(0)">
                            <span class="like-listing style-2"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                        </a>
                    @else
                        <a href="javascript:void(0)">
                            <span class="like-listing alt style-2"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                        </a>
                    @endif
                @endif
            </div>
            <div class="listing-price-info">
                <span class="">{{ $annonce->type }} </span>
            </div>
            <div class="listing-shot-info">
                <div class="row extra">
                    <div class="col-md-12">
                        <div class="listing-detail-info">
                            {{-- <span class="pricetag theme-bg">Restaurants</span> --}}
                            <span><i class="fa fa-phone" aria-hidden="true"></i> {{ $annonce->entreprise->contact }}</span>
                            <span>
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                @if ($annonce->entreprise->site_web)
                                    {{ $annonce->entreprise->site_web }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="rating padd-0">
                    {{ $annonce->note }}
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="{{ $i <= $annonce->note ? 'color' : '' }} fa fa-star" aria-hidden="true"></i>
                    @endfor

                    {{-- <a href="javascript:void(0)" data-toggle="modal" data-target="#share" onclick="shareAnnonce('{{ route('show', $annonce->slug) }}', '{{ $annonce->titre }}', '{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}', '{{ $annonce->type }}')" class="theme-cl annonce-share" style="float: right;">
                        <i class="fa fa-share theme-cl" aria-hidden="true"></i>
                        Partager
                    </a> --}}
                </div>
            </div>

            <div class="tp-author-basic-info mrg-top-0">
                <ul>
                    <li class="text-center padd-top-10 padd-bot-0">
                        <i class="fa fa-eye fa-lg" aria-hidden="true"></i>
                        {{ $annonce->view_count }}
                    </li>
                    <li class="text-center padd-top-10 padd-bot-0">
                        <i class="fa fa-heart fa-lg" aria-hidden="true"></i>
                        {{ $annonce->favorite_count }}
                    </li>
                    <li class="text-center padd-top-10 padd-bot-0">
                        <i class="fa fa-comment fa-lg" aria-hidden="true"></i>
                        {{ $annonce->comment_count }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
