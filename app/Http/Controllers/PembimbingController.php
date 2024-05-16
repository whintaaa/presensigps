<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    public function index(Request $request){
        $query = DB::table('pembimbing');
        $query->select('*');
        $query->join('divisi','divisi.id_divisi','=','pembimbing.id_divisi');
        $query->orderBy('nama_pl');
        if(!empty($request->nama_pl)){
            $query->where('nama_pl','like','%'.$request->nama_pl.'%');
        }
        if(!empty($request->kode_dept)){
            $query->where('pembimbing.id_divisi',$request->kode_dept);
        }
        $datapl= $query->paginate(2);
        $divisi = DB::table('divisi')
                    ->get();
        return view("data_pl.index",compact("datapl","divisi"));
    }
    public function simpandata_pl(Request $request){
        $nama_pl = $request->nama_pl ;
        $email_pl = $request->email_pl;
        $id_divisi = $request->id_divisi;
        $data=[
            'nama_pl' => $nama_pl ,
            'email_pl' => $email_pl,
            'id_divisi' => $id_divisi

        ];
        $cek = DB::table("pembimbing")->where('nama_pl',$nama_pl)->count();
        if($cek == 0){
            $simpan = DB::table('pembimbing')->insert($data);
            if($simpan){
                return Redirect::back()->with(['success' => 'Data telah ditambahkan']);
            }else{
                return Redirect::back()->with(['error'=> 'Hubungi Tim IT']);
            }
        }else{
            return Redirect::back()->with(['error'=> 'Nama Pembimbing Lapangan tersebut sudah ada']);
        }
    }
    public function hapusDatapl($id_pl)
    {
        $cek = DB::table("data_magang")->where('id_pl',$id_pl)->count();

        // Jika ada presensi, berikan pesan error dan kembalikan
        if ($cek > 0) {
            return redirect()->back()->with('error', 'Data tidak bisa dihapus karena terdaftar didata siswa/mahasiswa.');
        }

        $exists = DB::table('pembimbing')->where('id_pl', $id_pl)->exists();

        if ($exists) {
            DB::table('pembimbing')->where('id_pl', $id_pl)->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

    }
    public function editdata_pl($id_pl){
        $pembimbing = DB::table('pembimbing')
                    ->join('divisi','divisi.id_divisi','=','pembimbing.id_divisi')
                    ->where('id_pl',$id_pl)
                    ->first();
        $divisi = DB::table('divisi')->get();
        return view("data_pl.editdata",compact("pembimbing","divisi"));
    }
    public function updatedata_pl(Request $request){
        $id_pl = $request->id_pl;
        $nama_pl = $request->nama_pl ;
        $email_pl = $request->email_pl;
        $id_divisi = $request->id_divisi;
        $data=[
            'nama_pl' => $nama_pl ,
            'email_pl' => $email_pl,
            'id_divisi' => $id_divisi

        ];
        $update = DB::table('pembimbing')->where('id_pl',$id_pl)->update($data);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['error'=> 'Data Gagal Di Update']);
        }

    }


}
