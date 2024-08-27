@extends('layouts.main')
@section('container')

 <style>
    /* Custom CSS for full-width carousel */
    .carousel {
      width: 100%;
      height: 100vh;
    }
    
    .carousel .carousel-inner {
      height: 100%;
    }
    
    .carousel-item {
      height: 100%;
    }
    
    .carousel-item img {
      object-fit: cover;
      height: 100%;
      width: 100%;
    }
  </style>

</div>
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{asset('images/carousel/carousel1.png')}}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('images/carousel/tema.jpg')}}" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="{{asset('images/carousel/jadwal.png')}}" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<script>
 document.addEventListener('DOMContentLoaded', function () {
  var myCarousel = document.querySelector('#carouselExample');
  var carousel = new bootstrap.Carousel(myCarousel, {
    interval: 5000,
  });

  myCarousel.addEventListener('slid.bs.carousel', function () {
    var activeItem = myCarousel.querySelector('.carousel-item.active');

    if (!activeItem.nextElementSibling) {
      // Last slide reached, pause for 5 seconds and then go to the first slide
      carousel.pause();
      setTimeout(function () {
        carousel.to(0);
        carousel.cycle();
      }, 5000);
    }
  });
});
  </script>

<div class=" bg-dark text-light text-center">
  <br>
<h2>Tentang Kami</h2>
<p>Kami adalah sebuah komunitas rohani yang berdedikasi untuk memuliakan Tuhan, melayani sesama, dan membangun hubungan yang erat dengan Tuhan dan sesama manusia.<br> 
  Di gereja kami, kami percaya bahwa setiap individu memiliki nilai yang tak ternilai di hadapan Allah, dan kami berkomitmen untuk menciptakan lingkungan yang <br>
  inklusif, ramah, dan penuh kasih.</p>
  <h2> Visi </h2>
  <p>Visi kami adalah menjadi tempat di mana setiap orang dapat menemukan dan mengalami kehadiran Tuhan secara nyata, merasakan sukacita dalam persekutuan, dan diberdayakan <br>
     untuk menjalani hidup yang bermakna dan berpengaruh. Kami ingin menjadi saksi kasih dan kebenaran Kristus di tengah-tengah masyarakat Surabaya dan sekitarnya.<br>
     <a href="{{route('aboutus')}}" class="link-light">Selengkapnya</a></p>
     <br>
    </div>
    <div class=" bg-light text-dark text-center">
      <br>
      <h2>Jadwal Siaran</h2
        <p>Kami mengundang Anda untuk bergabung dalam siaran ibadah biasa yang dilaksanakan setiap hari Minggu. Ibadah pertama dimulai pukul 8 pagi, diikuti oleh <br>
          ibadah kedua pukul 10 pagi. Kami sangat berharap dapat beribadah bersama Anda dalam suasana yang penuh sukacita dan berkat.<br>
          <a href="{{route('livestream')}}" class="link-dark">Siaran</a></p></p>
        <br>
    </div>
    <div class=" bg-dark text-light text-center">
      <br>
      <h2>Pengumuman</h2
        <p>Kami memiliki beberapa pengumuman penting yang ingin kami sampaikan kepada Anda. Harap luangkan waktu sejenak untuk membaca pengumuman-pengumuman ini <br>
          agar Anda tetap terinformasi dan tidak ketinggalan informasi terbaru.<br>
          <a href="{{route('announcement')}}" class="link-light">Pengumuman</a></p>
        <br>
    </div>

{{-- <div class="jumbotron bg-dark text-white">
<h1 class="display-4 text-center"><b>Surabaya City Blessing Kemah Rajawali</b></h1>
<hr class="my-4">
</div> --}}
      @vite(['resources/js/app.js'])
@endsection
