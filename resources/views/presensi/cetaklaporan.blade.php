<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Laporan Presensi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  <style>@page { size: A4 }
    .datadiri{
        margin-top: 30px;
        font-size:12px
    }
    .tablepresensi{
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        font-size: 12px;
    }
    .tablepresensi>tr, th{
        border: 1px solid;
        padding: 8px;
        background-color: rgb(177, 174, 174);
    }
    .tablepresensi td{
        border: 1px solid;
        padding: 8px;
        text-align: center;
    }
  </style>
</head>
<body class="A4">
  <section class="sheet padding-10mm">
    <table style="width: 100%">
        <tr>
            <td style="width: 30px">
                <img src="{{asset('assets/img/ssblogo.jpg')}}" alt="PT.ssb Logo" width="180" height="100">
            </td>
            <td>
                <span style="font-weight: bold;font-size:18px">
                    LAPORAN PRESENSI <br>
                    PERIODE {{strtoupper($namabulan[$bulan])}}/{{$tahun}}<br>
                    PT. SANGGAR SARANA BAJA
                </span><br>
                <span><i>alamat:..</i></span>
            </td>
        </tr>
    </table>
    <table class="datadiri">
        <tr>
            <td>ID PKL</td>
            <td>:</td>
            <td>PKL{{$data->id_pkl}}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$data->nama_lengkap}}</td>
        </tr>
        <tr>
            <td>Instansi</td>
            <td>:</td>
            <td>{{$data->nama_instansi}}</td>
        </tr>
        <tr>
            <td>Pembimbing</td>
            <td>:</td>
            <td>{{$data->nama_pl}}</td>
        </tr>
        <tr>
            <td>Departement</td>
            <td>:</td>
            <td>{{$data->nama_divisi}}</td>
        </tr>
        <tr>
            <td>Lokasi PKL</td>
            <td>:</td>
            <td>{{$data->nama_lokasi}}</td>
        </tr>
    </table>
    <table class="tablepresensi">
        <tr>
            <th>No.</th>
            <th>TANGGAL</th>
            <th>HADIR</th>
            <th>JAM MASUK</th>
            <th>IZIN</th>
            <th>KETERANGAN</th>
        </tr>
        @php
            $iterationCounter = 1;
        @endphp
        @foreach ($presensi as $p)
        <tr>
            <td>{{$iterationCounter}}</td>
            <td>{{$p->tgl_presensi}}</td>
            <td><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 26 26">
                <path d="M 22.566406 4.730469 L 20.773438 3.511719 C 20.277344 3.175781 19.597656 3.304688 19.265625 3.796875 L 10.476563 16.757813 L 6.4375 12.71875 C 6.015625 12.296875 5.328125 12.296875 4.90625 12.71875 L 3.371094 14.253906 C 2.949219 14.675781 2.949219 15.363281 3.371094 15.789063 L 9.582031 22 C 9.929688 22.347656 10.476563 22.613281 10.96875 22.613281 C 11.460938 22.613281 11.957031 22.304688 12.277344 21.839844 L 22.855469 6.234375 C 23.191406 5.742188 23.0625 5.066406 22.566406 4.730469 Z"></path>
                </svg>
            </td>
            <td>{{$p->jam_in}}</td>
            <td>
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 24 24">
                    <path d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z"></path>
                    </svg>
            </td>
            <?php
            if ($p->jam_in <= '08:00:00') {
            ?>
                    <td>Tepat Waktu</td>
            <?php
                }else {
            ?>
                    <td>Terlambat</td>
            <?php
                };
            ?>
        </tr>
        @php
            $iterationCounter++;
        @endphp
        @endforeach
        @foreach ($izin as $i)
        <tr>
            <td>{{$iterationCounter}}</td>
            <td>{{$i->tgl_izin}}</td>
            <td><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 24 24">
                <path d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z"></path>
                </svg>
            </td>
            <td>
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 24 24">
                    <path d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z"></path>
                    </svg>
            </td>
            <?php
                if ($i->status == 'i') {
            ?>
                    <td>Izin</td>
            <?php
                }elseif ($i->status == 's') {
            ?>
                    <td>Sakit</td>
            <?php
                };
            ?>
            <td>{{$i->ket_izin}}</td>
        </tr>
        @php
            $iterationCounter++;
        @endphp
        @endforeach
        <tr>
            <th colspan="5">Total Kehadiran</th>
            <th>{{$presensi->count()}}</th>
        </tr>
        <tr>
            <th colspan="5">Total Izin</th>
            <th>{{$izin->count()}}</th>
        </tr>

    </table>
    <table width="100%" style="margin-top:100px">
        <tr>
            <td colspan="2" style="text-align: right; vertical-align:top">
                <i>lokasi, {{date('d-m-Y')}}</i>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align:buttom" height="200px">
                <u>nama</u><br>
                <i><b>jabatan</b></i>
            </td>
            <td style="text-align: center; vertical-align:buttom">
                <u>nama</u><br>
                <i><b>jabatan</b></i>
            </td>
        </tr>
    </table>
  </section>

</body>

</html>
