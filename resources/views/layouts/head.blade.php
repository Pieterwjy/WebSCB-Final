<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SCB || {{$title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}"
    @yield('head')
  </head>

<body class="d-flex flex-column h-100">
  @vite(['resources/js/app.js'])
  @yield('body')
    
  {{-- <footer class="bg-dark text-center text-lg-start fixed-bottom">
    <!-- Copyright -->
    <div class="text-center p-3 text-light" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2023 Copyright:
      <a class="text-light" href="{{ route('index') }}">scbkemahrajawali.site</a>
      <br>
      <a class="text-light" href="{{ route('login') }}">Login</a>
    </div>
    <!-- Copyright -->
  </footer> --}}
  <!-- Footer -->
<footer class="mt-auto text-center text-lg-start bg-light text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>© 2023 Copyright: Surabaya City Blessing</span>
    </div>
    
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="https://www.youtube.com/c/SCBKemahRajawali" class="me-4 text-reset">
        <i class="bi bi-youtube"></i>
      </a>
      <a href="https://www.facebook.com/scbkemahrajawali" class="me-4 text-reset">
        <i class="bi bi-facebook"></i>
      </a>
      <a href="https://www.instagram.com/scbkemahrajawali/" class="me-4 text-reset">
        <i class="bi bi-instagram"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  
  <!-- Section: Links  -->

  <!-- Copyright -->

  
  <!-- Copyright -->
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

<!-- Footer -->
</body>
</html>