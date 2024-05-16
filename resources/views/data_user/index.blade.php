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
            Data Admin
          </h2>
          <div class="page-pretitle">
            Presensi PKL PT.SANGGAR SARANA BAJA
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
                                <a href="#" class="btn btn-primary" id="btnTambahData_user">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col_12">
                                <form action="/admin/master/data_user" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="name" id="" class="form-control" placeholder="Nama admin" value="{{Request('name')}}">
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
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Departement</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datauser as $d)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$d -> name}}</td>
                                            <td>{{$d -> email_admin}}</td>
                                            <td>{{$d -> departement}}</td>
                                            <td style="text-align: center">
                                                <a href="#" class="btn btn-sm btn-warning btnEditData_user" data-id="{{$d->id}}">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pencil"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-danger btnHapusData_user" data-id="{{$d->id}}">
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
                                {{$datauser -> links('vendor.pagination.bootstrap-5')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-data_user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/admin/simpandata_user" method="POST" name="formdata_user" id="formdata_user">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                  <label class="form-label">Nama</label>
                  <input type="text" class="form-control" name="name" placeholder="nama admin" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email_admin" placeholder="email admin" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Departement</label>
                    <input type="text" class="form-control" name="departement" placeholder="Departement" required>
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
@endsection
@push('myscript')
<script>
    $(function(){
        $('#btnTambahData_user').click(function(){
            $('#modal-data_user').modal('show');
        });
        $('.btnHapusData_user').click(function(e){
            e.preventDefault(); // Mencegah aksi default
            var id = $(this).data('id');
            if(confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = '/admin/hapusdata_user/' + id;
            }
        });
        $('.btnEditData_user').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = '/admin/editdata_user/' + id;

        window.location.href = url;

    });
    })
</script>
@endpush
