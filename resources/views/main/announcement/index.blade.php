@extends('layouts.main')
@section('container')
@vite(['resources/js/app.js'])
<div class="d-flex align-items-center justify-content-between">
    <div class ='container-fluid'>
        <div class="jumbotron">
            <h1 class="display-4 text-center"><b>Pengumuman</b></h1>
            <hr class="my-4">
        </div>
    </div>
</div>
    <br>
   <div class="container" style="min-height: 66.1vh">
    <div class="accordion" id="accordionExample" style="
        --bs-accordion-active-bg: rgb(248, 249, 250);
        --bs-accordion-btn-focus-box-shadow: 0 0 0 0.25rem rgb(248, 249, 250);
    }">
        @if($posts->count() > 0)
        @foreach($posts as $rs)
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
                    <b>{!!$rs->title!!}, {!!$rs->published_at!!}</b>
                </button>
            </h2>
            <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @if($rs->image)
                    <div class="row">
                        <div class="col-2">
                            <img src="{{asset('storage/'.$rs->image)}}" class="img-fluid rounded border border-primary">
                        </div>
                        <div class="col-10">
                            <div class="truncate-text">
                                <!-- {{ $rs->excerpt }} -->
                            <article>
                        {!!$rs->excerpt!!}
                            </article>
                            </div>
                            
                            <a href="{{route('show_pengumuman', $rs->id)}}" class="link-secondary">Detil</a>
                        </div>
                    </div>
                    @else
                    <div class="truncate-text">
                        <!-- {{ $rs->excerpt }} -->
                        <article class="my-3 fs-5">
                        {!!$rs->excerpt!!}
            </article>
                    </div>
                    <a href="{{route('show_pengumuman', $rs->id)}}" class="link-secondary">Detil</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="text-center">Tidak Ada Pengumuman</div>
        @endif
    </div>
</div>

<style>
    .truncate-text {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 9; /* Number of lines to show */
        -webkit-box-orient: vertical;
    }
</style>


@endsection