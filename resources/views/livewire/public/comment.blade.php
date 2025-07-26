<div>
    <div>
        <div class="detail-wrapper">
            <div class="detail-wrapper-header">
                <h4>{{ $count }} Commentaire(s)</h4>
            </div>
            <div class="detail-wrapper-body">
                <ul class="review-list">
                    @foreach ($commentaires as $commentaire)
                        <li style="padding-top: 25px !important; padding-bottom: 5px !important;">
                            <div class="reviews-box">
                                <div class="review-body">
                                    <div class="review-avatar">
                                        <img alt="" src="{{ asset('assets_client/img/user-black.svg') }}" class="avatar avatar-140 photo">
                                    </div>
                                    <div class="review-content">
                                        <div class="review-info">
                                            <div class="review-comment">
                                                <div class="review-author">
                                                    <h5 style="font-size: 18px !important;">{{ $commentaire->auteur->nom }} {{ $commentaire->auteur->prenom }}</h5>
                                                </div>
                                                <div class="review-comment-stars">
                                                    @for ($i = 0; $i < $commentaire->note; $i++)
                                                        <i class="fa fa-star filled"></i>
                                                    @endfor
                                                    @for ($i = 0; $i < 5 - $commentaire->note; $i++)
                                                        <i class="fa fa-star empty"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="review-comment-date">
                                                <div class="review-date">
                                                    <span>{{ $commentaire->created_at->format('d-m-Y H:i:s') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p>{{ $commentaire->contenu }}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach

                    @empty($commentaires->count())
                        <li>
                            <p class="text-center">Aucun commentaire pour le moment</p>
                        </li>
                    @endempty

                    @if ($commentaires->hasMorePages())
                        <div class="text-center mrg-top-10">
                            <a class="theme-cl" href="javascript:void(0)" wire:click="loadMore({{ $annonce_id }}, {{ $perPage }})">Afficher plus</a>
                        </div>
                    @endif
                </ul>
            </div>
        </div>

        <div class="detail-wrapper" id="write-review">
            <div class="detail-wrapper-header">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <h4>Laisser un commentaire</h4>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        @if ($hasMessage)
                            @if ($message->type == 'success')
                                <div class="alert alert-success alert-dismissible fade show mrg-bot-0 padd-top-0 padd-bot-0" role="alert">
                                    <strong>{{ $message->message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @else
                                <div class="alert alert-danger alert-dismissible fade show mrg-bot-0 padd-top-0 padd-bot-0" role="alert">
                                    <strong>{{ $message->message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="detail-wrapper-body">

                <div class="row mrg-bot-10">
                    @if (!auth()->check())
                        <p class="text-center theme-cl">Vous devez être connecté pour laisser un commentaire</p>
                    @endif

                    <div class="col-md-12">
                        <div class="rating-opt">
                            <div class="jr-ratenode jr-nomal"></div>
                            <div class="jr-ratenode jr-nomal "></div>
                            <div class="jr-ratenode jr-nomal "></div>
                            <div class="jr-ratenode jr-nomal "></div>
                            <div class="jr-ratenode jr-nomal "></div>
                        </div> <br>
                        @error('note')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <form wire:submit.prevent="addComment">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="Nom*" readonly @if (auth()->check()) value="{{ auth()->user()->nom }}" @else disabled @endif>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="Prénom*" readonly @if (auth()->check()) value="{{ auth()->user()->prenom }}" @else disabled @endif>
                        </div>
                        <div class="col-sm-12">
                            <textarea class="form-control height-110" placeholder="Commentaire ..." wire:model='comment' required minlength="5" @if (!auth()->check()) disabled @endif></textarea>
                            @error('comment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" id="info">
                        <div class="col-sm-12">
                            @if (auth()->check())
                                <button class="btn theme-btn" id="btn-add" type="submit" wire:loading.attr="disabled">Commenter</button>
                            @else
                                <button class="btn theme-btn" type="button" data-toggle="modal" data-target="#signin">Commenter</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $('.rating-opt').start(function(cur) {
                $('#info').val(cur);
            });

            $('#btn-add').click(function() {
                var note = $('#info').val();
                Livewire.dispatch('updateNoteValue', [note]);
            });
        </script>

        <script>
            window.addEventListener('update:comment-value', event => {
                $('#annonce-commentaire').html(event.detail[0].value);
                $('#annonce-note').html(event.detail[0].note);
            });
        </script>
    @endpush
</div>
