@extends('multimedia.main')
@section('container')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Siaran Langsung</h1>
    <a href="{{ route('multimedia.livestream.create') }}" class="btn btn-primary">Buat Jadwal Siaran</a>
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
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($livestreams->count() > 0)
                @foreach($livestreams as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->title }}</td>
                        <td class="align-middle">{{ $rs->scheduled_at }}</td>
                        <td class="align-middle">{{ $rs->scheduled_end }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('multimedia.livestream.show', $rs->id)}}" type="button" class="btn btn-secondary">Detil</a>
                                <a href="{{route('multimedia.livestream.edit', $rs->id)}}" type="button" class="btn btn-warning">Ubah</a>
                                <form action="{{route('multimedia.livestream.destroy', $rs->id)}}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                   
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
                    <td class="text-center" colspan="5">Tidak Ada Jadwal</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection