@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="pageTitle">Profile</div>
    <div class="right"></div>
</div>
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
@endsection
@section('content')
<div class="row" style="margin-top: 4rem">
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
<form action="/presensi/{{$datadiri->id_pkl}}/updateprofile" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col" style="overflow-y:auto; height:700px; width:100%;">
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="PKL{{$datadiri->id_pkl}}" name="id_pkl" placeholder="ID PKL/MAGANG" autocomplete="off" disabled>
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{$datadiri->nama_lengkap}}" name="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{$datadiri->nmr_induk}}" name="nmr_induk" placeholder="Nomor Induk" autocomplete="off">
            </div>
        </div>
        <div class="form-group basic">
            <div class="input-wrapper">
                <select class="form-control" style="color: grey;" name="instansi">
                    <option value="{{$datadiri->id_instansi}}" selected>{{$datadiri->nama_instansi}}</option>
                    @foreach ($data_instansi as $inst)
                        <option value="{{$inst->id_instansi}}">{{$inst->nama_instansi}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="email" class="form-control" value="{{$datadiri->email}}" name="email" placeholder="Email" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{$datadiri->no_hp}}" name="no_hp" placeholder="No. HP" autocomplete="off">
            </div>
        </div>
        <div class="form-group basic">
            <div class="input-wrapper">
                <select class="form-control" style="color: grey;" name="divisi">
                    <option value="{{$datadiri->id_divisi}}" selected>{{$datadiri->nama_divisi}}</option>
                    @foreach ($data_divisi as $div)
                        <option value="{{$div->id_divisi}}">{{$div->nama_divisi}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group basic">
            <div class="input-wrapper">
                <select class="form-control" style="color: grey;" name="pembimbing">
                    <option value="{{$datadiri->id_pl}}" selected>{{$datadiri->nama_pl}}</option>
                    @foreach ($data_pl as $pl)
                        <option value="{{$pl->id_pl}}">{{$pl->nama_pl}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group basic">
            <div class="input-wrapper">
                <select class="form-control" style="color: grey;" name="lokasi">
                    <option value="{{$datadiri->id_lokasi}}" selected>{{$datadiri->nama_lokasi}}</option>
                    @foreach ($data_lokasi as $lok)
                        <option value="{{$lok->id_lokasi}}">{{$lok->nama_lokasi}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <button type="submit" class="btn btn-primary btn-block">
                    <ion-icon name="refresh-outline"></ion-icon>
                    Update
                </button>
            </div>
        </div>
</form>
<form action="/proseslogout" method="get" id="button-logout">
    @csrf
    <button type="submit" style="cursor:pointer;" class="btn btn-danger btn-block" onclick="event.preventDefault(); confirmLogout();">
        <ion-icon name="exit-outline"></ion-icon>Logout
    </button>
    </div>
</form>
@endsection

@push('myscript')
<script>
    function confirmLogout() {
        if (confirm('Apakah anda yakin ingin logout?')) {
            document.getElementById('button-logout').submit();
        }
    }
</script>
@endpush

