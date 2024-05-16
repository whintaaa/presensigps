@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="pageTitle">Data Izin/Sakit</div>
    <div class="right"></div>
</div>
@endsection
@section('content')
<div class="row" style="margin-top: 60px !important;">
    <div class="col" style="overflow-y:auto; min-height:700px; width:100%;">
    @foreach ($izin as $item)
        <ul class="listview image-listview">
            <li>
                <div class="item">
                    <div class="in">
                        <?php
                            $tanggal_izin = $item->tgl_izin;
                            $tanggal = date('d', strtotime($tanggal_izin));
                            $bulan = date('m', strtotime($tanggal_izin));
                            $tahun = date('Y', strtotime($tanggal_izin));
                            $tampilan_tanggal = "$tanggal ".$namabulan[$bulan*1]." $tahun";
                        ?>
                        @if ($item->tgl_izin)
                        <div><a href="#" style="color: black; font-size: 0.9rem">{{ $tampilan_tanggal}}</a><br>
                            <small class="text-muted">{{ $item->status=="s" ? "Sakit" : "Izin" }}</small><br>
                            <span class="text-muted">Keterangan : {{ $item->ket_izin }}</span></div>
                        @endif
                        @if($item->status_approved==1)
                        <span class="badge badge-success" style="font-size: 0.7rem; !important">Disetujui</span>
                        @elseif ($item->status_approved==2)
                        <span class="badge badge-danger" style="font-size: 0.7rem; !important">Ditolak</span>
                        @else
                        <span class="badge badge-warning" style="font-size: 0.7rem; !important">Pending</span>
                        @endif
                    </div>
                </div>
            </li>
        </ul>
    @endforeach
    </div>
</div>
<div class="fab-button bottom-right" style="margin-bottom: 70px">
    <a href="/presensi/formizin" class="fab"><ion-icon name="add-outline"></ion-icon></a>
</div>
@endsection
