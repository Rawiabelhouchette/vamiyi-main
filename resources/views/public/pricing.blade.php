@extends('layout.public.app')

@section('content')
    <section class="title-transparent page-title" style="background:url({{ asset('assets_client/img/cinet_pay.png') }}) no-repeat center center; background-size:cover;">
        <div class="container">
            <div class="title-content">
                <h1>Abonnement</h1>
                <div class="breadcrumbs">
                    <a href="{{ route('accueil') }}">Accueil</a>
                    <span class="gt3_breadcrumb_divider"></span>
                    <span class="current">Tarif</span>
                </div>
            </div>
        </div>
    </section>

    <div class="clearfix"></div>

    <section>
        <div class="container">
            {{-- display errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @foreach ($offres as $offre)
                @include('components.pricing-card', ['offre' => $offre, 'withModal' => true])
            @endforeach
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            applyMask('Togo');
        });
    </script>
@endpush
