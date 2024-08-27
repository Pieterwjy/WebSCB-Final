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
    <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Judul</label>
          <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Unggah Gambar</label>
            <img class="img-preview img-fluid mb-3 col-sm-5 rounded">
            <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
          </div>
        <div class="mb-3">
            <label for="body" class="form-label">Isi</label>
            <input id="body" type="hidden" name="body" required>
            <trix-editor input="body"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Buat Pengumuman</button>
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