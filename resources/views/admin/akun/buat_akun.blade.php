@extends('admin.main')
@section('container')
<h1 class="mb-0">Buat Akun</h1>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <hr />
    <form action="{{ route('admin.akun.store') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Name</span>
            <input type="text" name="name"  class="form-control" placeholder="Nama" aria-label="Name" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Email</span>
            <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Phone</span>
            <input type="tel" name="phone" class="form-control" placeholder="Phone" aria-label="Phone" aria-describedby="basic-addon1" required>
        </div>
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupRole">Hak Akses</label>
                <select class="form-select" name="role" id="inputGroupRole" >
                  {{-- <option value="admin">Admin</option> --}}
                  <option value="multimedia">Multimedia</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Password</span>
                <input type="password" name="password" class="form-control" placeholder="password" aria-label="Password" aria-describedby="basic-addon1" required>
            </div>
            <div class="row">
                <div class="d-grid">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection