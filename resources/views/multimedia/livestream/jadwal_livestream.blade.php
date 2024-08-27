@extends('multimedia.main')
@section('container')
<style>
  .countdown-container {
    font-size: 48px; /* Increase the font size as desired */
    text-align: center;
    font-weight: bold;
    margin-top: 100px;
  }
  
  </style>
  @if(is_null($livestreams))
  <div class ='container' style="position: absolute;
  top: 40%;">
     <div class="jumbotron jumbotron-fluid">
         <div class="container">
           <h1 class="display-4">Halaman Siaran</h1>
           <hr class="my-4">
           <p class="lead">Untuk Saat Ini, Belum Ada Jadwal Siaran. Jemaat bisa melihat siaran sebelumnya pada <a href="https://www.youtube.com/c/SCBKemahRajawali" class="me-4 text-reset">
            <i class="bi bi-youtube"></i>
          </a>
          </p>
         </div>
       </div>
  </div>
  @else
  <div class ='container' style="position: absolute;
   top: 35%;">
      <div class="jumbotron jumbotron-fluid">
          <div class="container">
          <h1 class="display-4 text-center"><br>Ibadah Akan Dimulai Pada: <b><div id="countdown"></div></b></h1>
            <hr class="my-4">
            {{-- <p class="lead text-center">Ibadah selanjutnya yang bertemakan {{$livestreams->title}},
               akan dimulai pada {{$livestreams->scheduled_at}}</p> --}}
               <p class="lead text-center">Jadwal ibadah tersedia yang bertemakan {{$livestreams->title}}.
                </p>
          </div>
        </div>
      </div>

      <script>
         function countdown(endDate) {
             const timer = setInterval(function() {
                 const now = new Date().getTime();
                 const distance = endDate - now;
                 
                 // Calculate days, hours, minutes, and seconds
                 const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                 const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                 const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                 const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                 
                 // Display the countdown
                 document.getElementById('countdown').innerHTML = days + ' Hari ' + hours + ' Jam '
                     + minutes + ' Menit ' + seconds + ' Detik ';
                 
                 // If the countdown is finished, clear the interval
                 if (distance < 0) {
                     clearInterval(timer);
                     document.getElementById('countdown').innerHTML = 'Memuat Ulang...';
                     location.reload();
                 }
             }, 1000);
         }
         
         window.onload = function() {
             const endDate = new Date('{{ $livestreams->scheduled_at }}').getTime();
             countdown(endDate);
         };
     </script>

  @endif
        
  
       
  
@endsection