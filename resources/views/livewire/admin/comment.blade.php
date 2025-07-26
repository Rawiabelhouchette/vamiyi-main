<div class="col-md-12 col-sm-12">
    <style>
        .small-listing-box {
            display: table;
            border-radius: 2px;
            position: relative;
            align-items: center;
            transition: all ease 0.4s;
            width: 100%;
        }

        .small-listing-box:hover,
        .small-listing-box:focus {
            -webkit-box-shadow: 0 10px 30px 0 rgba(58, 87, 135, 0.15);
            -moz-box-shadow: 0 10px 30px 0 rgba(58, 87, 135, 0.15);
            box-shadow: 0 10px 30px 0 rgba(58, 87, 135, 0.15);
            cursor: pointer;
        }

        /*--------------- Manage Listing ----------------*/
        .small-list-wrapper ul {
            padding: 0;
            margin: 0;
        }

        .small-list-wrapper ul li {
            list-style: none;
            margin-bottom: 10px;
            width: 100%;
            display: block;
        }

        .small-listing-box {
            display: table;
            border-radius: 2px;
            position: relative;
            align-items: center;
            transition: all ease 0.4s;
            width: 100%;
        }

        .small-listing-box:hover,
        .small-listing-box:focus {
            -webkit-box-shadow: 0 10px 30px 0 rgba(58, 87, 135, 0.15);
            -moz-box-shadow: 0 10px 30px 0 rgba(58, 87, 135, 0.15);
            box-shadow: 0 10px 30px 0 rgba(58, 87, 135, 0.15);
            cursor: pointer;
        }

        .small-list-action {
            float: right;
            margin-right: 15px;
            padding-top: 15px;
        }

        .small-list-detail {
            margin-top: 8px;
        }

        .small-list-img {
            max-width: 80px;
            padding: 5px;
            float: left;
            margin-right: 15px;
        }

        .small-list-img img {
            border-radius: 2px;
        }

        .small-list-detail {
            display: inline-block;
        }

        .small-list-detail h4 {
            margin-bottom: 2px;
        }

        .manage-listing .form-group {
            display: flex;
            align-items: center;
        }

        .avater-status {
            width: 12px;
            height: 12px;
            position: absolute;
            background: #07b107;
            line-height: 12px;
            border-radius: 50%;
            right: 26px;
            bottom: 8px;
        }

        .status-pulse {
            box-shadow: 0 0 0 rgba(7, 177, 7, .55);
            animation: status-pulse 2s infinite;
        }

        @-webkit-keyframes status-pulse {
            0% {
                -webkit-box-shadow: 0 0 0 0 rgba(7, 177, 7, .55)
            }

            70% {
                -webkit-box-shadow: 0 0 0 10px rgba(7, 177, 7, 0)
            }

            100% {
                -webkit-box-shadow: 0 0 0 0 rgba(7, 177, 7, 0)
            }
        }

        @keyframes status-pulse {
            0% {
                -moz-box-shadow: 0 0 0 0 rgba(7, 177, 7, .55);
                box-shadow: 0 0 0 0 rgba(7, 177, 7, .55)
            }

            70% {
                -moz-box-shadow: 0 0 0 10px rgba(7, 177, 7, 0);
                box-shadow: 0 0 0 10px rgba(7, 177, 7, 0)
            }

            100% {
                -moz-box-shadow: 0 0 0 0 rgba(7, 177, 7, 0);
                box-shadow: 0 0 0 0 rgba(7, 177, 7, 0)
            }
        }
    </style>
    <div class="card">
        <div class="card-header" style="margin: 0px; padding: 0px;">
            <div class="col-md-6 text-left" style="margin-top: 10px;">
                <span id="nbre-favoris">{{ $annonces->firstItem() }}-{{ $annonces->lastItem() }} sur {{ $annonces->total() }} commentaire(s)</span>
            </div>
            <div class="col-md-6 text-center">
                <input class="form-control" id="comment_search" type="text" value="" style="margin-top: 6px; margin-bottom: 6px; height: 35px;" placeholder="Afficher la recherche" wire:model.live.debounce.500ms='search'>
            </div>

        </div>

        <div class="card-body padd-l-0 padd-r-0">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="small-list-wrapper">
                            <ul class="mrg-top-5" id="table">
                                @forelse ($annonces as $annonce)
                                    <li>
                                        <div class="small-listing-box light-gray">
                                            <div class="small-list-img">
                                                <a href="{{ route('show', $annonce->slug) }}">
                                                    @if ($annonce->image)
                                                        <img class="img-responsive" src="{{ asset('storage/' . $annonce->imagePrincipale->chemin) }}" alt="" />
                                                    @else
                                                        <img class="img-responsive" src="http://via.placeholder.com/80x80" alt="" />
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="small-list-detail">
                                                <a href="{{ route('show', $annonce->slug) }}">
                                                    <h5 title="#">{{ $annonce->titre }} ( {{ $annonce->type }} )</h5>
                                                </a>
                                                <p class="mrg-bot-0">Commentaire : <a href="javascript:void(0)">{{ strlen($annonce->pivot->contenu) > 50 ? substr($annonce->pivot->contenu, 0, 50) . '...' : $annonce->pivot->contenu }}</a>
                                                    | <span>{{ $annonce->pivot->created_at->format('d-m-Y h:i') }}</span>
                                                </p>
                                            </div>
                                            <div class="small-list-action padd-top-5">
                                                <a class="light-gray-btn btn-square" href="{{ route('show', $annonce->slug) }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                {{-- <a href="javascript:void(0)" class="light-red-btn btn-square"><i class="ti-trash"></i></a> --}}
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <div class="col-md-12 col-sm-12">
                                        <div class="listing-shot grid-style">
                                            <div class="listing-shot-caption text-center mrg-top-20 mrg-bot-20">
                                                <h4>Aucune annonce trouvée</h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12 text-center" style="margin: 0px; padding: 0px;">
                        {{ $annonces->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
