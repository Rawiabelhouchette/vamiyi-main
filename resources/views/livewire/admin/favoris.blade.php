<div class="col-md-12 col-sm-12">

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
    <div class="card">
        <div class="card-body padd-l-0 padd-r-0">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6" style="margin-top: 10px;">
                        <span class="mrg-l-10" id="nbre-favoris">{{ $annonces->firstItem() }}-{{ $annonces->lastItem() }} sur {{ $annonces->total() }} favori(s)</span>
                    </div>
                    <div class="col-md-6 text-center">
                        <input class="form-control" id="favorite_search" type="text" value="" style="margin-top: 6px; margin-bottom: 6px; height: 35px;" placeholder="Afficher la recherche" wire:model.live.debounce.500ms='search'>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="small-list-wrapper">
                    <ul id="table">
                        @foreach ($annonces as $annonce)
                            <div class="col-md-6 col-sm-12 col-lg-4 col-xl-3">
                                <div class="listing-shot grid-style">
                                    <div class="listing-shot-img">
                                        <a href="{{ route('show', $annonce->slug) }}">
                                            @if ($annonce->image)
                                                <img class="img-responsive" src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" alt="">
                                            @else
                                                <img class="img-responsive" src="http://via.placeholder.com/800x800" alt="">
                                            @endif
                                        </a>
                                        {{-- <span class="approve-listing"><i class="fa fa-check"></i></span> --}}
                                    </div>
                                    <div class="listing-shot-caption">
                                        <a href="{{ route('show', $annonce->slug) }}">
                                            <h4>{{ $annonce->titre }}</h4>
                                            <p class="listing-location">{{ $annonce->description_courte }}</p>
                                        </a>
                                        <a href="javascript:void(0)" onclick="if (confirm('Are you sure you want to remove this from favorites?')) @this.call('updateFavoris', {{ $annonce->id }})">
                                            <span class="like-listing alt style-2"><i class="fa fa-trash" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                    <div class="listing-price-info">
                                        <span class="pricetag">{{ $annonce->type }} </span>

                                    </div>
                                    <div class="listing-shot-info">
                                        <div class="row extra">
                                            <div class="col-md-12">
                                                <div class="listing-detail-info">
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
                                    </div>
                                    <div class="listing-shot-info rating">
                                        <div class="row extra">

                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <a href="#">
                                                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                </a> {{ $annonce->nb_partage }}
                                                &nbsp;&nbsp;
                                                <i class="fa fa-eye" aria-hidden="true"></i> {{ $annonce->view_count }}
                                                &nbsp;&nbsp;
                                                <i class="fa fa-comment" aria-hidden="true"></i> {{ $annonce->comment_count }}
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="{{ $i <= $annonce->note ? 'color' : '' }} fa fa-star" aria-hidden="true"></i>
                                                    @endfor
                                                    &nbsp;&nbsp;
                                                    {{ $annonce->notation_count }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @empty($annonces->items())
                            <div class="col-md-12 col-sm-12">
                                <div class="listing-shot grid-style">
                                    <div class="listing-shot-caption text-center mrg-top-20 mrg-bot-20">
                                        <h4>Aucun commentaire trouvé</h4>
                                    </div>
                                </div>
                            </div>
                        @endempty
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                {{ $annonces->links() }}
            </div>
        </div>
    </div>
</div>
