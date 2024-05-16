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
            Edit Data Siswa/Mahasiswa
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
                        <form action="/admin/updatedata_magang" method="POST" name="formeditdata_magang" id="formeditdata_magang">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">ID PKL</label>
                                <input type="hidden" name="id_pkl" value="{{ $datadiri->id_pkl }}">
                                <input type="number" class="form-control" name="id_pkl2" value="{{ $datadiri->id_pkl }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_lengkap" value="{{$datadiri->nama_lengkap}}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor Induk</label>
                                <input type="number" class="form-control" name="nmr_induk" value="{{$datadiri->nmr_induk}}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$datadiri->email}}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor HP</label>
                                <input type="number" class="form-control" name="no_hp" value="{{$datadiri->no_hp}}" required>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Instansi/Sekolah</label>
                                    <select class="form-select" name="instansi" required>
                                    <option value="{{$datadiri->id_instansi}}">{{$datadiri->nama_instansi}}</option>
                                    @foreach ($instansi as $ins)
                                    <option value="{{$ins->id_instansi}}">{{$ins->nama_instansi}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Divisi/Departement</label>
                                    <select class="form-select" name="divisi" required>
                                    <option value="{{$datadiri->id_divisi}}">{{$datadiri->nama_divisi}}</option>
                                    @foreach ($divisi as $div)
                                    <option value="{{$div->id_divisi}}">{{$div->nama_divisi}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Pembimbing Lapangan</label>
                                    <select class="form-select" name="pembimbing" required>
                                    <option value="{{$datadiri->id_pl}}">{{$datadiri->nama_pl}}</option>
                                    @foreach ($pembimbing as $p)
                                    <option value="{{$p->id_pl}}">{{$p->nama_pl}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Lokasi PKL</label>
                                    <select class="form-select" name="lokasi" required>
                                    <option value="{{$datadiri->id_lokasi}}">{{$datadiri->nama_lokasi}}</option>
                                    @foreach ($lokasi_pkl as $lok)
                                    <option value="{{$lok->id_lokasi}}">{{$lok->nama_lokasi}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password Akun</label>
                                <input type="password" class="form-control" name="password" placeholder="jika tidak diedit silahkan di kosongi">
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
