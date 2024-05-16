@if ($histori->isEmpty())
<div class="alert alert-warning">
    <p style="color: white; text-align: center; margin-top: 8px; font-size: 15px;">Data tidak ditemukan</p>
</div>
@endif
@foreach ($histori as $item)
<div>
<ul class="listview image-listview">
    <li>
        <div class="item">
            <div class="icon-box bg-primary">
                <ion-icon name="location"></ion-icon>
            </div>
            <div class="in">
                <?php
                    $tanggal_presensi = $item->tgl_presensi;
                    $tanggal = date('d', strtotime($tanggal_presensi));
                    $bulan = date('m', strtotime($tanggal_presensi));
                    $tahun = date('Y', strtotime($tanggal_presensi));
                    $tampilan_tanggal = "$tanggal ".$namabulan[$bulan*1]." $tahun";
                ?>
                @if ($item->tgl_presensi)
                <div><a href="/presensi/detailhistori/{{ $item->tgl_presensi }}" style="color: black; font-size: 0.9rem">{{ $tampilan_tanggal}}</a></div>
                @endif
                <span class="badge badge-success" style="font-size: 0.7rem; !important">{{ $item->jam_in }}</span>
                <span class="badge badge-danger" style="font-size: 0.7rem; !important">{{ $item->jam_out != null ? $item->jam_out : 'belum absen' }}</span>
            </div>
        </div>
    </li>
</ul>
@endforeach
