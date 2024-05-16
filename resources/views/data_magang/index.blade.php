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
            Data Siswa/Mahasiswa
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
                        <div class="row">
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
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambahData_magang">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col_12">
                                <form action="/admin/master/data_magang" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_siswa" id="" class="form-control" placeholder="Nama Mahasiswa/Siswa" value="{{Request('nama_siswa')}}">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <select name="kode_dept" id="kode_dept" class="form-select">
                                                    <option value="">Departement/divisi</option>
                                                    @foreach ($divisi as $div)
                                                    <option value="{{$div->id_divisi}}" {{Request('kode_dept')==$div->id_divisi ? 'selected':''}}>{{$div->nama_divisi}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <select name="kode_lok" id="kode_lok" class="form-select">
                                                    <option value="">Lokasi PKL</option>
                                                    @foreach ($lokasi_pkl as $lok)
                                                    <option value="{{$lok->id_lokasi}}" {{Request('kode_lok')==$lok->id_lokasi ? 'selected':''}}>{{$lok->nama_lokasi}}</option>
                                                    @endforeach
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
                        <div class="row mt-2">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID PKL</th>
                                            <th>Nama Lengkap</th>
                                            <th>Nomor Induk</th>
                                            <th>Asal Instansi</th>
                                            <th>Divisi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datadiri as $d)
                                        <tr>
                                            <td>{{$loop->iteration + $datadiri->firstItem() -1}}</td>
                                            <td>PKL{{$d-> id_pkl}}</td>
                                            <td>{{$d -> nama_lengkap}}</td>
                                            <td>{{$d -> nmr_induk}}</td>
                                            <td>{{$d -> nama_instansi}}</td>
                                            <td>{{$d -> nama_divisi}}</td>
                                            <td style="text-align: center">
                                                <a href="#" class="btn btn-sm btn-primary btnLihatData_magang" data-id="{{$d->id_pkl}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-warning btnEditData_magang" data-id="{{$d->id_pkl}}">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pencil"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-danger btnHapusData_magang" data-id="{{$d->id_pkl}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$datadiri -> links('vendor.pagination.bootstrap-5')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-data_magang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Siswa/Mahasiswa PKL</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/admin/simpandata_magang" method="POST" name="formdata_magang" id="formdata_magang">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">ID PKL</label>
                    <input type="number" class="form-control" name="id_pkl" placeholder="id pkl siswa" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama_lengkap" placeholder="nama lengkap siswa" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Induk</label>
                    <input type="number" class="form-control" name="nmr_induk" placeholder="nomor induk siswa" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="email siswa" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input type="number" class="form-control" name="no_hp" placeholder="nomor hp siswa" required>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                      <label class="form-label">Instansi/Sekolah</label>
                      <select class="form-select" name="id_instansi" required>
                        <option value="">Pilih instansi/sekolah</option>
                        @foreach ($instansi as $ins)
                        <option value="{{$ins->id_instansi}}">{{$ins->nama_instansi}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                      <label class="form-label">Divisi/Departement</label>
                      <select class="form-select" name="id_divisi" required>
                        <option value="">Pilih divisi/departement</option>
                        @foreach ($divisi as $div)
                        <option value="{{$div->id_divisi}}">{{$div->nama_divisi}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                      <label class="form-label">Pembimbing Lapangan</label>
                      <select class="form-select" name="id_pl" required>
                        <option value="">Pilih pembimbing lapangan</option>
                        @foreach ($pembimbing as $p)
                        <option value="{{$p->id_pl}}">{{$p->nama_pl}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                      <label class="form-label">Lokasi PKL</label>
                      <select class="form-select" name="id_lokasi" required>
                        <option value="">Pilih lokasi pkl</option>
                        @foreach ($lokasi_pkl as $lok)
                        <option value="{{$lok->id_lokasi}}">{{$lok->nama_lokasi}}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password Akun</label>
                    <input type="password" class="form-control" name="password" placeholder="masukkan password" required>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                      Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                      Create new data
                    </button>
                  </div>
                </div>
              </div>
        </form>
      </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-lihatdata_magang" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Lihat Detail Siswa/Mahasiswa PKL</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST" name="lihatdata_magang" id="lihatdata_magang">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">ID PKL</label>
                    <input type="number" class="form-control" name="id_pkl" value="" disabled >
                </div>
                <div class="mb-3">
                  <label class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama_lengkap" value="" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Induk</label>
                    <input type="number" class="form-control" name="nmr_induk" value="" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input type="number" class="form-control" name="no_hp" value="" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Instansi</label>
                    <input type="text" class="form-control" name="instansi" value="" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Divisi/Departement</label>
                    <input type="text" class="form-control" name="divisi" value="" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pembimbing Lapangan</label>
                    <input type="text" class="form-control" name="pembimbing" value="" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi PKL</label>
                    <input type="text" class="form-control" name="lokasi_pkl" value="" disabled>
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
        $('#btnTambahData_magang').click(function(){
            $('#modal-data_magang').modal('show');
        });
        $('.btnLihatData_magang').click(function(){
            var id_pkl = $(this).data('id');
            $.ajax({
                url: '/admin/detaildata/' + id_pkl,
                method: 'GET',
                success: function(response){
                    // Mengisi nilai pada input modal dengan data yang diterima dari controller
                    $('#modal-lihatdata_magang').find('input[name="id_pkl"]').val(response.id_pkl);
                    $('#modal-lihatdata_magang').find('input[name="nama_lengkap"]').val(response.nama_lengkap);
                    $('#modal-lihatdata_magang').find('input[name="nmr_induk"]').val(response.nmr_induk);
                    $('#modal-lihatdata_magang').find('input[name="email"]').val(response.email);
                    $('#modal-lihatdata_magang').find('input[name="no_hp"]').val(response.no_hp);
                    $('#modal-lihatdata_magang').find('input[name="instansi"]').val(response.nama_instansi);
                    $('#modal-lihatdata_magang').find('input[name="divisi"]').val(response.nama_divisi);
                    $('#modal-lihatdata_magang').find('input[name="pembimbing"]').val(response.nama_pl);
                    $('#modal-lihatdata_magang').find('input[name="lokasi_pkl"]').val(response.nama_lokasi);
                    $('#modal-lihatdata_magang').modal('show');
                },
                error: function(xhr){
                    console.log(xhr);
                }
            });
        });
        $('.btnHapusData_magang').click(function(e){
            e.preventDefault(); // Mencegah aksi default
            var id_pkl = $(this).data('id');
            if(confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = '/admin/hapusdata_magang/' + id_pkl; // Mengarahkan ke route hapusdata_magang dengan id_pkl
            }
        });
        $('.btnEditData_magang').click(function(e) {
        e.preventDefault();
        var id_pkl = $(this).data('id');
        var url = '/admin/editdata/' + id_pkl;

        window.location.href = url;

    });
    })
</script>
@endpush
