<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class LokasiPklController extends Controller
{
    public function index(Request $request){
        $query = DB::table('lokasi_pkl');
        $query->select('*');
        $query->orderBy('nama_lokasi');
        if(!empty($request->nama_lokasi)){
            $query->where('nama_lokasi','like','%'.$request->nama_lokasi.'%');
        }
        $datalokasipkl= $query->paginate(2);
        return view("data_lokasipkl.index",compact("datalokasipkl"));
    }
    public function simpandata_lokasi(Request $request){
        $nama_lokasi = $request->nama_lokasi ;
        $alamat_lokasi = $request->alamat_lokasi;
        $lat_long = $request->lat_long;
        $data=[
            'nama_lokasi' => $nama_lokasi ,
            'alamat_lokasi' => $alamat_lokasi,
            'lat_long' => $lat_long

        ];
        $cek = DB::table("lokasi_pkl")->where('nama_lokasi',$nama_lokasi)->count();
        if($cek == 0){
            $simpan = DB::table('lokasi_pkl')->insert($data);
            if($simpan){
                return Redirect::back()->with(['success' => 'Data telah ditambahkan']);
            }else{
                return Redirect::back()->with(['error'=> 'Hubungi Tim IT']);
            }
        }else{
            return Redirect::back()->with(['error'=> 'Lokasi PKL Sudah Ada']);
        }
    }
    public function hapusDatalokasi($id_lokasi)
    {
        $cek = DB::table("data_magang")->where('id_lokasi',$id_lokasi)->count();

        if ($cek > 0) {
            return redirect()->back()->with('error', 'Data tidak bisa dihapus karena terdaftar didata siswa/mahasiswa.');
        }

        $exists = DB::table('lokasi_pkl')->where('id_lokasi', $id_lokasi)->exists();

        if ($exists) {
            DB::table('lokasi_pkl')->where('id_lokasi', $id_lokasi)->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

    }
    public function editdata_lokasi($id_lokasi){
        $lokasi = DB::table('lokasi_pkl')
                    ->where('id_lokasi',$id_lokasi)
                    ->first();
        return view("data_lokasipkl.editdata",compact("lokasi"));
    }
    public function updatedata_lokasi(Request $request){
        $id_lokasi = $request->id_lokasi;
        $nama_lokasi = $request->nama_lokasi ;
        $alamat_lokasi = $request->alamat_lokasi;
        $lat_long = $request->lat_long;
        $data=[
            'nama_lokasi' => $nama_lokasi ,
            'alamat_lokasi' => $alamat_lokasi,
            'lat_long' => $lat_long

        ];
        $update = DB::table('lokasi_pkl')->where('id_lokasi',$id_lokasi)->update($data);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['error'=> 'Data Gagal Di Update']);
        }

    }

}
