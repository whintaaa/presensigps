@extends('layouts.admin.tabler')
<style>
table thead tr th{
    font-size: 12px !important;
}
table tbody tr td{
    font-size: 12px !important;
}
.alert1 {
  padding: 15px;
  background-color: #04da4b;
  color: white;
}
.alert2 {
  padding: 15px;
  background-color: #f44336;
  color: white;
}
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <h2 class="page-title">
            Histori Presensi Siswa/Mahasiswa
          </h2>
          <div class="page-pretitle">
            PKL/MAGANG PT.SANGGAR SARANA BAJA
          </div>
        </div>
      </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col_12">
                                <form action="/admin/presensi/histori" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_siswa" id="" class="form-control" placeholder="Nama Mahasiswa/Siswa" value="{{Request('nama_siswa')}}">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <select name="bulan" id="bulan" class="form-select">
                                                    <option value="">Pilih bulan</option>
                                                    @for ($i=1; $i<=12; $i++)
                                                        <option value="{{ $i }}" {{Request('bulan')==$i ? 'selected':''}}>{{ $namabulan[$i] }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <select name="tahun" id="tahun" class="form-select">
                                                    @php
                                                    $thnsekarang = date("Y");
                                                    @endphp
                                                    <option value="">Pilih tahun</option>
                                                    @for ($tahun=$thnpresensi; $tahun<=$thnsekarang; $tahun++)
                                                        <option value="{{ $tahun }}" {{Request('tahun')==$i ? 'selected':''}}>{{ $tahun }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if (!empty(Request::get('nama_siswa'))||!empty(Request::get('bulan')))
                        <div class="row mt-2">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Total Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $totalKehadiran }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                        <div class="row mt-2">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID PKL</th>
                                            <th>Nama</th>
                                            <th>Instansi</th>
                                            <th>Departemen</th>
                                            <th>Lokasi PKL</th>
                                            <th>Tanggal</th>
                                            <th>Hadir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presensihistori as $p)
                                        <tr>
                                            <td>{{$loop->iteration + $presensihistori->firstItem() -1}}</td>
                                            <td>PKL{{$p-> id_pkl}}</td>
                                            <td>{{$p->nama_lengkap}}</td>
                                            <td>{{$p->nama_instansi}}</td>
                                            <td>{{$p->nama_divisi}}</td>
                                            <td>{{$p->nama_lokasi}}</td>
                                            <td>{{$p->tgl_presensi}}</td>
                                            <?php
                                                if ($p->jam_in <= '08:00:00') {
                                            ?>
                                                    <td><span class="badge bg-success text-white">{{$p->jam_in}}</span></td>
                                            <?php
                                                }else {
                                            ?>
                                                    <td><span class="badge bg-danger text-white">{{$p->jam_in}}</span></td>
                                            <?php
                                                };
                                            ?>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                                {{$presensihistori -> links('vendor.pagination.bootstrap-5')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
