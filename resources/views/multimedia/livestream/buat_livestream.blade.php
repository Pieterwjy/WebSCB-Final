@extends('multimedia.main')
@section('container')
<div class="col-lg-8" style="margin-bottom:7em">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('multimedia.livestream.store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Judul</label>
          <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="youtube_embed_url" class="form-label">Alamat YouTube Embed</label>
            <input type="text" class="form-control" id="" name="youtube_embed_url" required>
        </div>
        <div class="mb-3">
            <label for="scheduled_at" class="form-label">Tanggal & Jam Mulai</label>
            <input type="datetime-local" class="form-control" id="" name="scheduled_at" required>
        </div>
        <div class="mb-3">
            <label for="scheduled_end" class="form-label">Tanggal & Jam Berakhir</label>
            <input type="datetime-local" class="form-control" id="" name="scheduled_end" required>
        </div>
        <button type="submit" class="btn btn-primary">Buat Jadwal Siaran</button>
      </form>
    @endsection
</div>
