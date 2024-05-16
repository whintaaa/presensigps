<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Laporan Hadir Presensi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  <style>@page { size: A4 landscape}
    .tablepresensi{
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        font-size: 9px;
    }
    .tablepresensi>tr, th{
        border: 1px solid;
        padding: 5px;
        background-color: rgb(177, 174, 174);

    }
    .tablepresensi td{
        border: 1px solid;
        padding: 5px;
        text-align: center;
    }
  </style>
</head>
<body class="A4 landscape">
  <section class="sheet padding-10mm">
    <table style="width: 100%">
        <tr>
            <td style="width: 30px">
                <img src="{{asset('assets/img/ssblogo.jpg')}}" alt="PT.ssb Logo" width="180" height="100">
            </td>
            <td>
                <span style="font-weight: bold;font-size:18px">
                    REKAP PRESENSI KEHADIRAN<br>
                    PERIODE {{strtoupper($namabulan[$bulan])}}/{{$tahun}}<br>
                    PT. SANGGAR SARANA BAJA
                </span><br>
                <span><i>alamat:..</i></span>
            </td>
        </tr>
    </table>
    <table class="tablepresensi">
        <tr>
            <th rowspan="2">ID PKL</th>
            <th rowspan="2">Nama Lengkap</th>
            <th rowspan="2">Pembimbing Lapangan</th>
            <th colspan="{{$daysInMonth}}">Tanggal</th>
            <th rowspan="2">Total Hadir</th>
        </tr>
        <tr>
            <?php for($i=1; $i<=$daysInMonth; $i++){
            ?>
            <th>{{$i}}</th>
            <?php
            }
            ?>
        </tr>
        @foreach ($rekaphadir as $data)
            <tr>
                <td>{{$data->id_pkl}}</td>
                <td>{{$data->nama_lengkap}}</td>
                <td>{{$data->nama_pl}}</td>
                <?php
                    $totalhadir=0;
                    for($i=1; $i<=$daysInMonth; $i++){
                        $tgl="tgl_".$i;
                        if(empty($data->$tgl)){
                            $totalhadir += 0;
                        }else {
                            $totalhadir += 1;
                        }
                ?>
                    <td>{{$data->$tgl}}</td>
                <?php
                    }
                ?>
                <td>{{$totalhadir}}</td>

            </tr>
        @endforeach
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
<body class="A4 landscape">
    <section class="sheet padding-10mm">
      <table style="width: 100%">
          <tr>
              <td style="width: 30px">
                  <img src="{{asset('assets/img/ssblogo.jpg')}}" alt="PT.ssb Logo" width="180" height="100">
              </td>
              <td>
                  <span style="font-weight: bold;font-size:18px">
                      REKAP DATA IZIN / SAKIT<br>
                      PERIODE {{strtoupper($namabulan[$bulan])}}/{{$tahun}}<br>
                      PT. SANGGAR SARANA BAJA
                  </span><br>
                  <span><i>alamat:..</i></span>
              </td>
          </tr>
      </table>
      <table class="tablepresensi">
          <tr>
              <th rowspan="2">ID PKL</th>
              <th rowspan="2">Nama Lengkap</th>
              <th colspan="{{$daysInMonth}}">Tanggal</th>
              <th rowspan="2">Total izin</th>
          </tr>
          <tr>
              <?php for($i=1; $i<=$daysInMonth; $i++){
              ?>
              <th>{{$i}}</th>
              <?php
              }
              ?>
          </tr>
          @foreach ($rekapizin as $data)
              <tr>
                  <td>{{$data->id_pkl}}</td>
                  <td>{{$data->nama_lengkap}}</td>
                  <?php
                      $totalizin=0;
                      for($i=1; $i<=$daysInMonth; $i++){
                          $izin="izin_".$i;
                          if(empty($data->$izin)){
                              $totalizin += 0;
                          }else {
                              $totalizin += 1;
                          }
                  ?>
                      <td>{{$data->$izin}}</td>
                  <?php
                      }
                  ?>
                  <td>{{$totalizin}}</td>

              </tr>
          @endforeach
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
