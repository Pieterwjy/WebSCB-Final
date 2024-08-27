@extends('layouts.main')
@section('container')
<div class ='container-fluid'>
    <div class="jumbotron">
        <h1 class="display-4 text-center"><b>Lokasi Kami</b></h1>
        <hr class="my-4">
    </div>
</div>
    <style>
      #map {
        height: 100%;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  <body>
    <div class="container-fluid" >
      <div class="row">
        <div class="col-md-6">
          <h3><i class="bi bi-geo-alt-fill"></i> Alamat</h3>
          <label for="email">Jalan Satelit Utara V FT-19, Surabaya, Indonesia, 60187</label>
        </div>
        <div class="col-md-6">
          <h3><i class="bi bi-envelope-fill"></i> Email</h3>
          <div class="form-group">
            <label for="email">scbkemahrajawali@gmail.com</label>
          </div>
        </div>
      </div>
    </div>
    <div class ='container-fluid' >
      <div class="jumbotron">
          <hr class="my-4">
      </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <h3><i class="bi bi-clock-fill"></i> Jam Kantor</h3>
        <p>Senin - Sabtu: 08:00 - 16:00</p>
        <p>Minggu       : Libur</p>
      </div>
      
      <div class="col-md-6">
        <h3><i class="bi bi-phone-fill"></i> Telepon</h3>
        <p>0317340540</P>
        </div>
        
      </div>
      
    </div>
    <div id="map"></div>
    
  </div>

    <script>
      var map;
      function initMap() {
        const myLatLng = { lat: -7.262868099999998, lng: 112.6879699 };
        map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 18
        });

        new google.maps.Marker({
        position: myLatLng,
        map,
        title: "Hello World!"
  });
        window.initMap = initMap;
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_ipb2z79uW7HLXi1WBVPmvCMZpPJqgVI&callback=initMap"
    async defer></script>
    <div class="container" style="min-height: 43vh"></div>
  </body>
@endsection