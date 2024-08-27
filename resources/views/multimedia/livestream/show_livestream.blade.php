@extends('multimedia.main')
@section('container')
<div class="d-flex align-items-center justify-content-between">
    <div class ='container-fluid'>
        <div class="jumbotron">
            <h1 class="display-4 text-center"><b>Siaran Langsung</b></h1>
            <hr class="my-4">
            <div class=" container text-center my-5 ratio ratio-16x9">
                <iframe src="{{$livestreams->youtube_embed_url}}?autoplay=1&mute=1" allowfullscreen allow='autoplay'></iframe>
            </div>
        </div>
    </div>
</div>
<div class = 'container text-center'>
<p>Kami dengan rendah hati menyampaikan persembahan kami kepada Tuhan. Kami mengundang Anda untuk ikut berperan dengan menyumbangkan waktu, bakat, dan sumber daya <br> Anda
    dalam pelayanan dan pembangunan kerajaan-Nya. Untuk memberikan persembahan secara online atau mengetahui lebih lanjut, silakan gunakan QR code di bawah ini untuk  <br>
    mengakses memberi donasi.<br></p>
    <img  src="{{asset('images/qr.png')}}" height="25%" width="25%">
    <br>
    <br>
    <br>
    <br>
    <br>
@endsection