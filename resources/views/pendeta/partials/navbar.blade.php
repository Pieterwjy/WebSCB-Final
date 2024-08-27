<nav class="navbar sticky-top navbar-expand-lg bg-light py-3">
    <div class="container-fluid ">
      <a class="navbar-brand" href="{{ route('pendeta.dashboard') }}"><img src={{asset('images/logoscb.png')}} width="60" height="60">Surabaya City Blessing - Pendeta Dasbor</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          {{-- <li class="nav-item">
            <a class="nav-link {{ ($title === "Halaman Utama") ? 'active' : "" }}" aria-current="page" href="{{ route('pendeta.dashboard') }}">Dashboard</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Pengaturan Pengumuman") ? 'active' : "" }}" href="{{ route('pendeta.pengumuman.index') }}">Pengumuman</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Pengaturan Akun") ? 'active' : "" }}" href="{{ route('pendeta.akun.index') }}">Akun</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Logout") ? 'active' : "" }}" aria-current="page" href="{{ route('pendeta.logout') }}">Keluar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>