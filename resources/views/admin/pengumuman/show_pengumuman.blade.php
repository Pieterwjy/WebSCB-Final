@extends('admin.main')
@section('container')
<div style="margin-bottom:7em">
    @if($posts->image)
     <center>
        <img src="{{asset('storage/'.$posts->image)}}" class="img-fluid rounded border border-primary">
     </center>
    @else
    @endif


    <div class ='container-fluid'>
        <div class="jumbotron">
            <h1 class="display-4"><b>{!!$posts->title!!}</b></h1>
            <hr class="my-4">
            <p>Dibuat oleh : {{ $posts->user->name }}, Pada : {!!$posts->published_at!!}</p>
        </div>
    </div>
            <article class="my-3 fs-5">
                {!!$posts->body!!}
            </article>
</div>
<br>
<br>
<br>
<br>
@endsection