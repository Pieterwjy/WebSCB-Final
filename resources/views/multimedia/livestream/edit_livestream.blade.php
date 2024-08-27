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
    <form action="{{ route('multimedia.livestream.update',$livestreams->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$livestreams->title}}" required>
          </div>
          <div class="mb-3">
              <label for="youtube_embed_url" class="form-label">Alamat YouTube Embed</label>
              <input type="text" class="form-control" id="" name="youtube_embed_url" value="{{$livestreams->youtube_embed_url}}" required>
          </div>
          <div class="mb-3">
              <label for="scheduled_at" class="form-label">Tanggal & Jam Mulai</label>
              <input type="datetime-local" class="form-control" id="" name="scheduled_at" value="{{$livestreams->scheduled_at}}" required>
          </div>
          <div class="mb-3">
              <label for="scheduled_end" class="form-label">Tanggal & Jam Berakhir</label>
              <input type="datetime-local" class="form-control" id="" name="scheduled_end" value="{{$livestreams->scheduled_end}}" required>
          </div>
          <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupRole">Status</label>
            <select class="form-select" name="status" id="inputGroupRole">
                <option value="{{ $livestreams->status}}">{{ $livestreams->status}}</option>
                <option value="scheduled">Scheduled</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ubah</button>
      </form>
    @endsection
</div>
