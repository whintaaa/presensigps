@extends('layouts.presensi')
@section('content')
    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                <img src="assets/img/ssblogo.jpg" alt="LOGO PT.SSB" class="imaged" style="width: 100px; height: 60px; !important">
            </div>
            <div id="user-info">
                <h3 id="user-name">{{Auth::guard('data_magang')->user()->nama_lengkap}}</h3>
                <span id="user-role">PKL{{Auth::guard('data_magang')->user()->id_pkl}}</span><p></p>
                <span id="user-role">{{ $datadiri -> nama_divisi }}</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/editprofile" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/izin" class="danger" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Izin</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/presensi/histori" class="warning" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="location"></ion-icon>
                                </div>
                                <?php if ($presensihariini != null): ?>
                                    <a href="/viewpresensi" style="color: white">
                                        <div class="presencedetail">
                                            <h4 class="presencetitle">Masuk</h4>
                                            <span>{{ $presensihariini -> jam_in  }}</span>
                                        </div>
                                    </a>
                                <?php else: ?>
                                    <a href="/presensi/create" style="color: white">
                                        <div class="presencedetail">
                                            <h4 class="presencetitle">Masuk</h4>
                                            <span>Belum Absen</span>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="location"></ion-icon>
                                </div>
                                <?php if ($presensihariini != null && $presensihariini->jam_out != null): ?>
                                    <a href="/viewpresensi" style="color: white">
                                        <div class="presencedetail">
                                            <h4 class="presencetitle">Pulang</h4>
                                            <span>{{ $presensihariini -> jam_out  }}</span>
                                        </div>
                                    </a>
                                <?php else: ?>
                                    <a href="/presensi/create" style="color: white">
                                        <div class="presencedetail">
                                            <h4 class="presencetitle">Pulang</h4>
                                            <span>Belum Absen</span>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="rekappresensi">
            <h3>Rekap Presensi {{$bulantahun}}</h3>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important">
                            <span class="badge bg-danger" style="position: absolute; top: 3px; right: 8px; font-size:0.6rem; z-index: 999">{{$rekapbulanini->jmlhadir}}</span>
                            <ion-icon name="accessibility" style="font-size: 1.6rem;" class="text-success"></ion-icon>
                            <br><span style="font-size: 0.8rem">Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important">
                            <span class="badge bg-danger" style="position: absolute; top: 3px; right: 8px; font-size:0.6rem; z-index: 999">{{$izinbulanini->jmlizin}}</span>
                            <ion-icon name="newspaper" style="font-size: 1.6rem;" class="orange"></ion-icon>
                            <br><span style="font-size: 0.8rem">Izin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important">
                            <span class="badge bg-danger" style="position: absolute; top: 3px; right: 8px; font-size:0.6rem; z-index: 999">{{$izinbulanini->jmlsakit}}</span>
                            <ion-icon name="medkit" style="font-size: 1.6rem;" class="text-warning"></ion-icon>
                            <br><span style="font-size: 0.8rem">Sakit</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 16px 12px !important">
                            <span class="badge bg-danger" style="position: absolute; top: 3px; right: 8px; font-size:0.6rem; z-index: 999">{{$rekapbulanini->jmltelat}}</span>
                            <ion-icon name="alarm" style="font-size: 1.8rem;" class="text-danger"></ion-icon>
                            <br><span style="font-size: 0.8rem">Telat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Presensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Aktivitas
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($historibulanini as $list)
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="location"></ion-icon>
                                </div>
                                <div class="in">
                                    <?php
                                        $tanggal_presensi = $list->tgl_presensi;
                                        $tanggal = date('d', strtotime($tanggal_presensi));
                                        $bulan = date('m', strtotime($tanggal_presensi));
                                        $tahun = date('Y', strtotime($tanggal_presensi));
                                        $tampilan_tanggal = "$tanggal ".$namabulan[$bulan*1]." $tahun";
                                    ?>
                                    @if ($list->tgl_presensi)
                                    <div><a href="/detailpresensi/{{ $list->tgl_presensi }}" style="color: black; font-size: 0.9rem">{{ $tampilan_tanggal}}</a></div>
                                    @endif
                                    <span class="badge badge-success" style="font-size: 0.7rem; !important">{{ $list->jam_in }}</span>
                                    <span class="badge badge-danger" style="font-size: 0.7rem; !important">{{ $list->jam_out != null ? $list->jam_out : 'belum absen' }}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($historibulanini as $list)
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="document-outline" role="img" class="md hydrated"
                                        aria-label="document outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <?php
                                        $tanggal_presensi = $list->tgl_presensi;
                                        $tanggal = date('d', strtotime($tanggal_presensi));
                                        $bulan = date('m', strtotime($tanggal_presensi));
                                        $tahun = date('Y', strtotime($tanggal_presensi));
                                        $tampilan_tanggal = "$tanggal ".$namabulan[$bulan*1]." $tahun";
                                    ?>
                                    @if ($list->tgl_presensi)
                                    <div><a href="/detailpresensi/{{ $list->tgl_presensi }}" style="color: black; font-size: 0.9rem">{{ $tampilan_tanggal}}</a><br>
                                        <span class="text-muted">{{ $list->aktivitas }}</span></div>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
