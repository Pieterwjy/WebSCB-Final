@extends('admin.main')
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
    <form action="{{ route('admin.pengumuman.update',$posts->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label">Judul</label>
          <input type="text" class="form-control" id="title" name="title" value="{{$posts->title}}" required>
        </div>

        <div class="mb-3">



            <label for="image" class="form-label">Unggah Gambar</label>
            <input type="hidden" name="oldImage" value="{{$posts->image}}">
            @if($posts->image)
            <img src="{{asset('storage/'.$posts->image)}}" class="img-preview img-fluid mb-3 col-sm-5 rounded d-block">
            
            @else
            <img class="img-preview img-fluid mb-3 col-sm-5 rounded">
            @endif
            
            <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
          </div>
        <div class="mb-3">
            <label for="body" class="form-label">Isi</label>
            <input id="body" type="hidden" name="body" value="{{$posts->body}}" required>
            <trix-editor input="body"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Ubah</button>
      </form>
</div>
<script>
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function (oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }

</script>
@endsection