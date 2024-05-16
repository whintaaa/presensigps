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
            DATA IZIN
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
                        <form action="/presensi/cetakizin" method="POST" target="_blank">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <select name="bulan" id="bulan" class="form-select">
                                            @for ($i=1; $i<=12; $i++)
                                                <option value="{{ $i }}" {{ date("m") == $i ? 'selected' : '' }}>{{ $namabulan[$i] }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="form-group">
                                        <select name="tahun" id="tahun" class="form-select">
                                            @php
                                            $thnsekarang = date("Y");
                                            @endphp
                                            @for ($tahun=$thnizin; $tahun<=$thnsekarang; $tahun++)
                                                <option value="{{ $tahun }}" {{ date("Y") == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info w-100" name="cetak">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-printer"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                                            Cetak
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success w-100" name="excel">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-download"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 11l5 5l5 -5" /><path d="M12 4l0 12" /></svg>
                                            Export Excel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row mt-2">
                            <div class="col">
                                @php
                                $messagesuccess = Session::get('success');
                                $messageerror = Session::get('error');
                                @endphp
                                @if (Session::get('success'))
                                <div class="alert1">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <strong>Berhasil!</strong>{{ $messagesuccess }}
                                </div>
                                @endif
                                @if (Session::get('error'))
                                <div class="alert2">
                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                    <strong>Gagal!</strong>{{ $messageerror }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col_12">
                                <form action="/admin/presensi/data_izin" method="GET">
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
                                                    @for ($tahun=$thnizin; $tahun<=$thnsekarang; $tahun++)
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
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>ID PKL</th>
                                            <th>Nama</th>
                                            <th>Instansi</th>
                                            <th>Departemen</th>
                                            <th>Lokasi PKL</th>
                                            <th>Izin</th>
                                            <th>Alasan</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataizin as $d)
                                        <tr>
                                            <td>{{$loop->iteration + $dataizin->firstItem() -1}}</td>
                                            <td>{{$d->tgl_izin}}</td>
                                            <td>PKL{{$d-> id_pkl}}</td>
                                            <td>{{$d -> nama_lengkap}}</td>
                                            <td>{{$d -> nama_instansi}}</td>
                                            <td>{{$d -> nama_divisi}}</td>
                                            <td>{{$d -> nama_lokasi}}</td>
                                            <?php
                                                if ($d->status == 'i') {
                                            ?>
                                                    <td><span class="badge bg-danger text-white">Izin</span></td>
                                            <?php
                                                }elseif ($d->status == 's') {
                                            ?>
                                                    <td><span class="badge bg-danger text-white">Sakit</span></td>
                                            <?php
                                                };
                                            ?>
                                            <td>{{$d -> ket_izin}}</td>
                                            <?php
                                                if ($d->status_approved == 2) {
                                            ?>
                                                    <td><span class="badge bg-danger text-white">ditolak</span></td>
                                            <?php
                                                }elseif ($d->status_approved == 1) {
                                            ?>
                                                    <td><span class="badge bg-success text-white">disetujui</span></td>
                                            <?php
                                                }elseif ($d->status_approved == 0){
                                            ?>
                                                    <td><span class="badge bg-yellow text-white">pending</span></td>
                                            <?php
                                                };
                                            ?>

                                            <td style="text-align: center">
                                                @if ($d->status_approved == 0)
                                                <a href="#" class="btn btn-sm btn-primary btnApproved" id="btnApproved" data-id="{{$d->id_izin}}">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z" /><path d="M16 5l3 3" /><path d="M9 7.07a7 7 0 0 0 1 13.93a7 7 0 0 0 6.929 -6" /></svg>
                                                </a>
                                                @else ()
                                                <a href="/admin/{{$d->id_izin}}/batalapproved" id="btnBatal" class="btn btn-sm btn-danger" data-id="{{$d->id_izin}}" onclick="return confirm('Apakah Anda yakin ingin membatalkan APPROVED?')">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-square-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 2h-14a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3 -3v-14a3 3 0 0 0 -3 -3zm-9.387 6.21l.094 .083l2.293 2.292l2.293 -2.292a1 1 0 0 1 1.497 1.32l-.083 .094l-2.292 2.293l2.292 2.293a1 1 0 0 1 -1.32 1.497l-.094 -.083l-2.293 -2.292l-2.293 2.292a1 1 0 0 1 -1.497 -1.32l.083 -.094l2.292 -2.293l-2.292 -2.293a1 1 0 0 1 1.32 -1.497z" /></svg>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$dataizin -> links('vendor.pagination.bootstrap-5')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-izin_approved" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm Approved</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/admin/izinapproved" method="POST" name="form_approved" id="form_approved">
            @csrf
            <input type="hidden" name="id_sakit" id="id_sakit_form" value="">
            <div class="modal-body">
                <div class="mb-3">
                  <select name="status_approved" id="status_approved" class="form-select">
                    <option value="1">Disetujui</option>
                    <option value="2">Ditolak</option>
                  </select>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                      Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-send"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                        Send
                    </button>
                  </div>
                </div>
              </div>
        </form>
      </div>
    </div>
</div>
@endsection
@push('myscript')
<script>
    $(function(){
        $('#btnApproved').click(function(e){
            var id_izin = $(this).attr("data-id");
            $('#id_sakit_form').val(id_izin);
            $('#modal-izin_approved').modal('show');
        });
    });

</script>
@endpush
