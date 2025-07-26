<div>
    @php
        $defaultColor = '#ff3a72';
    @endphp
    
    @if (Auth::check())
        <button wire:click='updateFavoris' wire:loading.attr="disabled" class="buttons padd-10 favoris-btn-show" style="background: {{ $isEnabled ? $defaultColor : 'white' }}; border: 1px solid {{ $isEnabled ? $defaultColor : 'grey' }}; color: {{ $isEnabled ? 'white' : 'grey' }};">
            <i class="fa fa-heart"></i>
            <span class="hidden-xs">Favoris</span>
        </button>
    @else
        <button data-toggle="modal" data-target="#signin" class="buttons padd-10 favoris-btn-show" style="background: white; border: 1px solid grey; color: grey;">
            <i class="fa fa-heart"></i>
            <span class="hidden-xs">Favoris</span>
        </button>
    @endif

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.favoris-btn-show').click(function() {
                    $('#share').hide();
                    $('#modal-gallery').hide();
                });
            });
        </script>
    @endpush
</div>
