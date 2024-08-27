@extends('pendeta.head')

@section('body')
    @include('pendeta.partials.navbar')

    <div class="container mt-4">
        @yield('container')
    </div>
@endsection
