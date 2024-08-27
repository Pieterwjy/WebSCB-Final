@extends('multimedia.head')

@section('body')
    @include('multimedia.partials.navbar')

    <div class="container mt-4">
        @yield('container')
    </div>
@endsection
