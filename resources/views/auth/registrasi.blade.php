@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="/" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Registrasi</div>
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
<div class="row" style="margin-top: 5rem">
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
<form action="/prosesregistrasi" method="POST" enctype="multipart/form-data" id="form_registrasi">
    @csrf
    <div class="col" style="overflow-y:auto; height:700px; width:100%;">
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="number" class="form-control" value="" name="id_pkl" id="id_pkl" placeholder="ID PKL (hanya angka)" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="" name="nmr_induk" id="nmr_induk" placeholder="Nomor Induk" autocomplete="off">
            </div>
        </div>
        <div class="form-group basic">
            <div class="input-wrapper">
                <select class="form-control" style="color: grey;" name="instansi" id="instansi">
                    <option value="">Pilih Instansi Anda</option>
                    @foreach ($data_instansi as $inst)
                        <option value="{{$inst->id_instansi}}">{{$inst->nama_instansi}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="email" class="form-control" value="" name="email" id="email" placeholder="Email" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="number" class="form-control" value="" name="no_hp" id="no_hp" placeholder="No. HP" autocomplete="off">
            </div>
        </div>
        <div class="form-group basic">
            <div class="input-wrapper">
                <select class="form-control" style="color: grey;" name="divisi" id="divisi">
                    <option value="">Pilih Divisi/Departement Anda</option>
                    @foreach ($data_divisi as $div)
                        <option value="{{$div->id_divisi}}">{{$div->nama_divisi}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group basic">
            <div class="input-wrapper">
                <select class="form-control" style="color: grey;" name="pembimbing" id="pembimbing">
                    <option value="">Pilih Pembimbing Anda</option>
                    @foreach ($data_pl as $pl)
                        <option value="{{$pl->id_pl}}">{{$pl->nama_pl}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group basic">
            <div class="input-wrapper">
                <select class="form-control" style="color: grey;" name="lokasi" id="lokasi">
                    <option value="">Pilih Lokasi Anda</option>
                    @foreach ($data_lokasi as $lok)
                        <option value="{{$lok->id_lokasi}}">{{$lok->nama_lokasi}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <button type="submit" class="btn btn-primary btn-block">
                    <ion-icon name="refresh-outline"></ion-icon>
                    Send
                </button>
            </div>
        </div>
</form>
@endsection
@push('myscript')
<script>
$("#form_registrasi").submit(function(){
var id_pkl = $("#id_pkl").val();
var nama_lengkap = $("#nama_lengkap").val();
var nmr_induk = $("#nmr_induk").val();
var instansi = $("#instansi").val();
var email = $("#email").val();
var no_hp = $("#no_hp").val();
var divisi = $("#divisi").val();
var pembimbing = $("#pembimbing").val();
var lokasi = $("#lokasi").val();
var password = $("#password").val();
if (id_pkl == ""){
    Swal.fire({
        title: 'Oops !',
        text: 'ID Belum Diisi',
        icon: 'warning'
    });
    return false;
}else if (nama_lengkap == ""){
    Swal.fire({
        title: 'Oops !',
        text: 'Nama Belum Diisi',
        icon: 'warning'
    });
    return false;
}else if (nmr_induk == ""){
    Swal.fire({
        title: 'Oops !',
        text: 'Nomor Induk Belum Diisi',
        icon: 'warning'
    });
    return false;
}else if (instansi == ""){
    Swal.fire({
        title: 'Oops !',
        text: 'Anda Belum Memilih Instansi',
        icon: 'warning'
    });
    return false;
}else if (email == ""){
    Swal.fire({
        title: 'Oops !',
        text: 'Email Belum Diisi',
        icon: 'warning'
    });
    return false;
}else if (no_hp == ""){
    Swal.fire({
        title: 'Oops !',
        text: 'No Telepon Belum Diisi',
        icon: 'warning'
    });
    return false;
}else if (divisi == ""){
    Swal.fire({
        title: 'Oops !',
        text: 'Anda Belum Memilih Divisi/Departement',
        icon: 'warning'
    });
    return false;
}else if (pembimbing == ""){
    Swal.fire({
        title: 'Oops !',
        text: 'Anda Belum Memilih Pembimbing Lapangan',
        icon: 'warning'
    });
    return false;
}else if (lokasi == ""){
    Swal.fire({
        title: 'Oops !',
        text: 'Anda Belum Memilih Lokasi PKL',
        icon: 'warning'
    });
    return false;
}else if (password == ""){
    Swal.fire({
        title: 'Oops !',
        text: 'Password Belum Diisi',
        icon: 'warning'
    });
    return false;
}
});
</script>
@endpush

