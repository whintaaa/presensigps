@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="/presensi/histori" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>

    <div class="pageTitle">Detail Presensi</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
<!-- In the head section or at the end of the body of your layouts.presensi -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
@endsection
@section('content')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if ($presensihariini != null && $presensihariini->lokasi_in)
        var coordinatesIn = "{{ $presensihariini->lokasi_in }}".split(',');
        var mapIn = L.map('mapIn').setView([coordinatesIn[0], coordinatesIn[1]], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap contributors'
        }).addTo(mapIn);
        L.marker([coordinatesIn[0], coordinatesIn[1]]).addTo(mapIn)
            .bindPopup('Presensi Masuk: <strong>{{ $presensihariini->jam_in }}</strong>')
            .openPopup();
        @endif

        @if ($presensihariini != null && $presensihariini->lokasi_out)
        var coordinatesOut = "{{ $presensihariini->lokasi_out }}".split(',');
        var mapOut = L.map('mapOut').setView([coordinatesOut[0], coordinatesOut[1]], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap contributors'
        }).addTo(mapOut);
        L.marker([coordinatesOut[0], coordinatesOut[1]]).addTo(mapOut)
            .bindPopup('Presensi Pulang: <strong>{{ $presensihariini->jam_out }}</strong>')
            .openPopup();
        @endif
    });
</script>
<?php
    $tanggal_presensi = $presensihariini->tgl_presensi;
    $tanggal = date('d', strtotime($tanggal_presensi));
    $bulan = date('m', strtotime($tanggal_presensi));
    $tahun = date('Y', strtotime($tanggal_presensi));
    $tampilan_tanggal = "$tanggal ".$namabulan[$bulan*1]." $tahun";
?>
<div class="section full mt-2">
    <div class="section-title">Title</div>
    <div class="wide-block pt-2 pb-2">
        Detail presensi tanggal {{ $tampilan_tanggal}}
    </div>
</div>
<div class="col">
    @if ($presensihariini != null && $presensihariini->jam_out == null)
    <div class="form-group boxed">
        <h3>Presensi Masuk:</h3>
    </div>
        <!-- Container for Map Display -->
    <div id="mapIn" style="height: 250px;"></div>
    <div class="form-group boxed">
        Jam Absen Masuk : {{ $presensihariini->jam_in }} <br>
        Aktivitas : {{ $presensihariini->aktivitas }}
    </div>
    <div class="form-group boxed">
        <h3>Anda Belum Presensi Pulang</h3>
    </div>
    @elseif ($presensihariini != null && $presensihariini->jam_out != null)
    <div class="form-group boxed">
        <h3>Presensi Masuk:</h3>
    </div>
    <div id="mapOut" style="height: 250px;"></div>
    <div class="form-group boxed">
        Lokasi Absen Masuk : {{ $presensihariini->lokasi_in }} <br>
        Jam Absen Masuk : {{ $presensihariini->jam_in }} <br>
        Aktivitas : {{ $presensihariini->aktivitas }}
    </div>
    <div class="form-group boxed">
        <h3>Presensi Pulang:</h3>
    </div>
    <div class="form-group boxed">
        Lokasi Absen Pulang : {{ $presensihariini->lokasi_out }} <br>
        Jam Absen Pulang : {{ $presensihariini->jam_out }}
    </div>
    @else
    <div class="form-group boxed">
        <h3>Anda Belum Absen</h3>
    </div>
    @endif
</div>

@endsection
