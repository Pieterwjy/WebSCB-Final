@extends('layouts.head')

@section('body')
    @include('partials.navbar')

    <div class="container">
        @yield('container')
    </div>
@endsection
