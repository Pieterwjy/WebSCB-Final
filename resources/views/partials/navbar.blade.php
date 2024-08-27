<nav class="navbar sticky-top navbar-expand-lg bg-light py-3">
    <div class="container-fluid ">
      <a class="navbar-brand" href="{{ route('index') }}"><img src={{asset('images/logoscb.png')}} width="60" height="60">Surabaya City Blessing</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Halaman Utama") ? 'active' : "" }}" aria-current="page" href="{{ route('index') }}">Halaman Utama</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Tentang Kami") ? 'active' : "" }}" href="{{ route('aboutus') }}">Tentang Kami</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Siaran Langsung") ? 'active' : "" }}" href="{{ route('livestream') }}">Siaran Langsung</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Lokasi") ? 'active' : "" }}" href="{{ route('address') }}">Lokasi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Pengumuman") ? 'active' : "" }}" href="{{ route('announcement') }}">Pengumuman</a>
          </li>
          <li class ="nav-item">
            {{-- Goes To app.js --}}
            <button id="notification-button" class="btn btn-light">
              <svg xmlns="http://www.w3.org/2000/svg" width ="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12v4c0 .55.45 1 1 1h3v-6c0-2.21 1.79-4 4-4s4 1.79 4 4v6h3c.55 0 1-.45 1-1v-4c0-5.52-4.48-10-10-10zm-2 18h4v2H8v-2z" />
              </svg>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>