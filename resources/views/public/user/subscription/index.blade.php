@extends('layout.public.app')

@section('content')
    <!-- ================ Listing Detail Basic Information ======================= -->
    @include('public.user.title-banner', ['title' => 'Mes abonnements'])
    <!-- ================ End Listing Detail Basic Information ======================= -->

    <section class="show-case">
        <div class="container">
            <div class="row">

                @include('public.user.menu', ['category' => 5])

                @livewire('public.user.comment')

            </div>
        </div>
    </section>
@endsection
