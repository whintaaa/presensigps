<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class DivisiController extends Controller
{

    public function index(Request $request){
        $query = DB::table('divisi');
        $query->select('*');
        $query->orderBy('nama_divisi');
        if(!empty($request->nama_divisi)){
            $query->where('nama_divisi','like','%'.$request->nama_divisi.'%');
        }
        $datadivisi= $query->paginate(2);
        return view("data_divisi.index",compact("datadivisi"));
    }
    public function simpandata_divisi(Request $request){
        $nama_divisi = $request->nama_divisi ;
        $data=[
            'nama_divisi' => $nama_divisi ,
        ];
        $cek = DB::table("divisi")->where('nama_divisi',$nama_divisi)->count();
        if($cek == 0){
            $simpan = DB::table('divisi')->insert($data);
            if($simpan){
                return Redirect::back()->with(['success' => 'Data telah ditambahkan']);
            }else{
                return Redirect::back()->with(['error'=> 'Hubungi Tim IT']);
            }
        }else{
            return Redirect::back()->with(['error'=> 'Nama Divisi Sudah Ada']);
        }
    }
    public function hapusDatadivisi($id_divisi)
    {
        $cek = DB::table("data_magang")->where('id_divisi',$id_divisi)->count();
        $cek2 = DB::table("pembimbing")->where('id_divisi',$id_divisi)->count();
        if ($cek > 0) {
            return redirect()->back()->with('error', 'Data tidak bisa dihapus karena terdaftar didata siswa/mahasiswa.');
        }
        if ($cek2 > 0) {
            return redirect()->back()->with('error', 'Data tidak bisa dihapus karena terdaftar didata pembimbing.');
        }

        $exists = DB::table('divisi')->where('id_divisi', $id_divisi)->exists();

        if ($exists) {
            DB::table('divisi')->where('id_divisi', $id_divisi)->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

    }
    public function editdata_divisi($id_divisi){
        $divisi = DB::table('divisi')
                    ->where('id_divisi',$id_divisi)
                    ->first();
        return view("data_divisi.editdata",compact("divisi"));
    }
    public function updatedata_divisi(Request $request){
        $id_divisi = $request->id_divisi;
        $nama_divisi = $request->nama_divisi ;
        $data=[
            'nama_divisi' => $nama_divisi ,
        ];
        $update = DB::table('divisi')->where('id_divisi',$id_divisi)->update($data);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['error'=> 'Data Gagal Di Update']);
        }

    }
}
