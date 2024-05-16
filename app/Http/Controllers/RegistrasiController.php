<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class RegistrasiController extends Controller
{
    public function index(){
        $data_divisi = DB::table('divisi')->get();
        $data_pl = DB::table('pembimbing')->get();
        $data_instansi = DB::table('instansi')->get();
        $data_lokasi = DB::table('lokasi_pkl')->get();
        return view('auth.registrasi', compact('data_divisi','data_pl','data_instansi','data_lokasi'));
    }
    public function registrasi(Request $request){
        $id_pkl = $request->id_pkl;
        $nama_lengkap = $request->nama_lengkap;
        $nmr_induk = $request->nmr_induk;
        $id_instansi = $request->instansi;
        $email = $request->email;
        $no_hp = $request->no_hp;
        $id_divisi = $request->divisi;
        $id_pl = $request->pembimbing;
        $id_lokasi = $request->lokasi;
        $password = Hash::make($request->password);
        $data =[
            'id_pkl' => $id_pkl,
            'nama_lengkap'=> $nama_lengkap,
            'nmr_induk'=> $nmr_induk,
            'email'=> $email,
            'no_hp'=> $no_hp,
            'id_divisi'=> $id_divisi,
            'id_pl'=> $id_pl,
            'id_instansi'=> $id_instansi,
            'id_lokasi'=> $id_lokasi,
            'password' => $password
        ];
        $cek = DB::table("data_magang")->where('id_pkl',$id_pkl)->count();
        if($cek == 0){
            $simpan = DB::table('data_magang')->insert($data);
            if($simpan){
                return Redirect::back()->with(['success' => ' Silahkan Login']);
            }else{
                return Redirect::back()->with(['error'=> 'Hubungi Tim IT']);
            }
        }else{
            return Redirect::back()->with(['error'=> ' ID_PKL Sudah Registrasi']);
        }
    }
}
