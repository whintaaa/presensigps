@extends('layouts.presensi')
@section('header')
<style>
    .datepicker-modal{
        max-height: 430px !important;
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
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="/presensi/izin" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Form Izin/Sakit</div>
    <div class="right"></div>
</div>
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
<div class="row">
    <div class="col">
        <form action="/presensi/storeizin" method="POST" enctype="multipart/form-data" id="formizin">
            @csrf
            <div class="col">
                <div class="input-field">
                    <input type=text name="tgl_izin" id="tgl_izin" class="datepicker" required>
                    <label for="tgl_izin">Tanggal Izin</label>
                </div>
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <select class="form-control" style="color: grey;" name="status" id="status">
                            <option value="">Pilih Izin/Sakit</option>
                            <option value="i">Izin</option>
                            <option value="s">Sakit</option>
                        </select>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <textarea name="ket_izin" class="form-control" id="ket_izin" placeholder="Isi Keterangan Izin Anda" rows="3" cols="50"></textarea>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <button type="submit" class="btn btn-primary btn-block">
                            send
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('myscript')
<script>
var currYear = (new Date()).getFullYear();

$(document).ready(function() {
  $(".datepicker").datepicker({
    format: "yyyy-mm-dd"
  });

  $("#formizin").submit(function(){
    var tgl_izin = $("#tgl_izin").val();
    var status = $("#status").val();
    var ket_izin = $("#ket_izin").val();
    if (tgl_izin == ""){
        Swal.fire({
            title: 'Oops !',
            text: 'Tanggal belum Dipilih',
            icon: 'warning'
        });
        return false;
    }else if (status == ""){
        Swal.fire({
            title: 'Oops !',
            text: 'Status belum Dipilih',
            icon: 'warning'
        });
        return false;
    }else if (ket_izin == ""){
        Swal.fire({
            title: 'Oops !',
            text: 'Keterangan belum diisi',
            icon: 'warning'
        });
        return false;
    }
  })
});
</script>
@endpush
