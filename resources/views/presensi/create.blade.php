@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="/dashboard" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">E-Presensi</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
<style>
    #map { height: 200px; }
    .col {
        overflow-y:auto;
        height:600px;
        width:100%;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection

@section('content')
<form action="#">
    <input type="hidden" value="{{$lat}}" name="lat" id="lat">
    <input type="hidden" value="{{$long}}" name="long" id="long">
</form>
<div class="section full mt-2">
    <div class="section-title">Title</div>
    <div class="wide-block pt-2 pb-2">
        Silahkan presensi dan cek lokasi anda...
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="input-field">
            <label for="tgl_presensi">Pilih Tanggal:</label><br>
            <input type="date" id="tgl_presensi" name="tgl_presensi">
        </div>
        <div class="form-group boxed">
            Click dibawah ini untuk menampilkan lokasimu...
            <div id="map"></div><br>
            <button onclick="getLocation()" id="inilokasi" class="btn btn-outline-info">Click here!</button>
            <p id="lok1"></p>
        </div>
        <input type="hidden" name="lokasi" id="lokasi">
        @if ($cek == 1)
        <button id="takeabsen" class="btn btn-danger btn-block">
            <ion-icon name="camera-outline"></ion-icon>
            Absen Pulang
        </button>
        @else
        <div class="form-group boxed">
            <div class="input-wrapper">
                <textarea name="aktivitas" class="form-control" id="aktivitas" placeholder="Isi Aktivitas Harian" rows="2" cols="50"></textarea>
            </div>
        </div>
        @php
        $currentTime = date("H:i"); // Get current time
        @endphp
        @if ($currentTime > "08:00")
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <textarea name="alasan_terlambat" class="form-control" id="alasan_terlambat" placeholder="Alasan Terlambat" rows="2" cols="50"></textarea>
                </div>
            </div>
        @endif
        <button id="takeabsen" class="btn btn-primary btn-block">
            <ion-icon name="camera-outline"></ion-icon>
            Absen Masuk
        </button>
        @endif
    </div>
</div>
@endsection

@push('myscript')
<script>
    const x = document.getElementById("lokasi");
    const x1 = document.getElementById("lok1");
    var lat = document.getElementById("lat").value;
    var long = document.getElementById("long").value;
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x1.innerHTML = "lokasi tidak dapat ditampilkan";
        }
    };

    function showPosition(position) {
        x.value = position.coords.latitude +","+ position.coords.longitude;
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 16);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
        //var circle = L.circle([-6.292996845070444, 106.8152155011684], {
        var circle = L.circle([lat, long], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 150
        }).addTo(map);
    };

    $("#takeabsen").click(function(e){
        var lokasi = $("#lokasi").val();
        var aktivitas = $("#aktivitas").val();
        var tgl_presensi = $("#tgl_presensi").val();
        var alasan_terlambat = $("#alasan_terlambat").val();
        $.ajax({
            type: 'POST',
            url:'/presensi/store',
            data:{
                _token:"{{ csrf_token() }}",
                tgl_presensi:tgl_presensi,
                lokasi:lokasi,
                aktivitas:aktivitas,
                alasan_terlambat:alasan_terlambat
            },
            cache:false,
            success:function(respond){
                var status = respond.split("|");
                if(status[0] == "success"){
                    Swal.fire({
                        title: 'Berhasil !',
                        text: status[1],
                        icon: 'success',
                        confirmButtonText: 'OK'
                    })
                    setTimeout("location.href='/dashboard'", 3000);
                }else{
                    Swal.fire({
                        title: 'Gagal !',
                        text: status[1],
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                }
            }
        });
    });
</script>
@endpush

