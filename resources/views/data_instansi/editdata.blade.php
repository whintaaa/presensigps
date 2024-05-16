@extends('layouts.admin.tabler')
<style>
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
            Edit Data Instansi Siswa/Mahasiswa PKL
          </h2>
        </div>
      </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
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
                <div class="card">
                    <div class="card-body">
                        <form action="/admin/updatedata_instansi" method="POST" name="formeditdata_magang" id="formeditdata_magang">
                            @csrf
                            <input type="hidden" name="id_instansi" value="{{ $instansi->id_instansi }}">
                            <div class="mb-3">
                                <label class="form-label">Nama Instansi</label>
                                <input type="text" class="form-control" name="nama_instansi" value="{{$instansi->nama_instansi}}" required>
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Contact Instansi <small><i>*boleh dikosongi</i></small></label>
                                  <input type="number" class="form-control" name="contact_instansi" value="{{$instansi->contact_instansi}}">
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Alamat Instansi</label>
                                  <textarea class="form-control" name="alamat_instansi" id="" cols="30" rows="5" required>{{$instansi->alamat_instansi}}</textarea>
                              </div>
                            <div class="row mt-2">
                                <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pencil"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                    Edit Data
                                </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
