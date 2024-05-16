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
            Data Pembimbing PKL
          </h2>
          <div class="page-pretitle">
            PT.SANGGAR SARANA BAJA
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
                                <a href="#" class="btn btn-primary" id="btnTambahData_pl">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col_12">
                                <form action="/admin/master/data_pl" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_pl" id="" class="form-control" placeholder="Nama Pembimbing" value="{{Request('nama_pl')}}">
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
                                            <th>Nama Pembimbing</th>
                                            <th>Email Pembimbing</th>
                                            <th>Divisi/Departement</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datapl as $d)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$d -> nama_pl}}</td>
                                            <td>{{$d -> email_pl}}</td>
                                            <td>{{$d -> nama_divisi}}</td>
                                            <td style="text-align: center">
                                                <a href="#" class="btn btn-sm btn-warning btnEditData_pl" data-id="{{$d->id_pl}}">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pencil"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-danger btnHapusData_pl" data-id="{{$d->id_pl}}">
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
                                {{$datapl -> links('vendor.pagination.bootstrap-5')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-data_pl" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pembimbing Lapangan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/admin/simpandata_pl" method="POST" name="formdata_pl" id="formdata_pl">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">Nama</label>
                  <input type="text" class="form-control" name="nama_pl" placeholder="nama pembimbing lapangan" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email_pl" placeholder="email pembimbing lapangan" required>
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
@endsection
@push('myscript')
<script>
    $(function(){
        $('#btnTambahData_pl').click(function(){
            $('#modal-data_pl').modal('show');
        });
        $('.btnHapusData_pl').click(function(e){
            e.preventDefault();
            var id_pl = $(this).data('id');
            if(confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = '/admin/hapusdata_pl/' + id_pl;
            }
        });
        $('.btnEditData_pl').click(function(e) {
        e.preventDefault();
        var id_pl = $(this).data('id');
        var url = '/admin/editdata_pl/' + id_pl;

        window.location.href = url;

    });
    })
</script>
@endpush


