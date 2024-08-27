@extends('pendeta.main')
@section('container')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Pengumuman</h1>
    <a href="{{ route('pendeta.pengumuman.create') }}" class="btn btn-primary">Buat Pengumuman</a>
</div>

@if ($errors->has('error'))
    <div class="alert alert-danger">
        {{ $errors->first('error') }}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($posts->count() > 0)
                @foreach($posts as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->title }}</td>
                        <td class="align-middle">{{ $rs->excerpt }}</td>
                        <td class="align-middle">{{ $rs->published_at }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('pendeta.pengumuman.show', $rs->id)}}" type="button" class="btn btn-secondary">Detil</a>
                                <a href="{{route('pendeta.pengumuman.edit', $rs->id)}}" type="button" class="btn btn-warning">Ubah</a>
                                <form action="{{route('pendeta.pengumuman.destroy', $rs->id)}}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                   
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger m-0">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Tidak Ada Pengumuman</td>
                </tr>
            @endif
        </tbody>
    </table>
    <br>
    <br>
    <br>
@endsection