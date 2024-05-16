<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index(Request $request){
        $query = DB::table('instansi');
        $query->select('*');
        $query->orderBy('nama_instansi');
        if(!empty($request->nama_instansi)){
            $query->where('nama_instansi','like','%'.$request->nama_instansi.'%');
        }
        $datainstansi= $query->paginate(2);
        return view("data_instansi.index",compact("datainstansi"));
    }
    public function simpandata_instansi(Request $request){
        $nama_instansi = $request->nama_instansi ;
        $alamat_instansi = $request->alamat_instansi;
        $contact_instansi = $request->contact_instansi;
        $data=[
            'nama_instansi' => $nama_instansi ,
            'alamat_instansi' => $alamat_instansi,
            'contact_instansi' => $contact_instansi

        ];
        $cek = DB::table("instansi")->where('nama_instansi',$nama_instansi)->count();
        if($cek == 0){
            $simpan = DB::table('instansi')->insert($data);
            if($simpan){
                return Redirect::back()->with(['success' => 'Data telah ditambahkan']);
            }else{
                return Redirect::back()->with(['error'=> 'Hubungi Tim IT']);
            }
        }else{
            return Redirect::back()->with(['error'=> 'Nama Instansi Sudah Ada']);
        }
    }
    public function hapusDataInstansi($id_instansi)
    {
        $cek = DB::table("data_magang")->where('id_instansi',$id_instansi)->count();

        if ($cek > 0) {
            return redirect()->back()->with('error', 'Data tidak bisa dihapus karena terdaftar didata siswa/mahasiswa.');
        }

        $exists = DB::table('instansi')->where('id_instansi', $id_instansi)->exists();

        if ($exists) {
            DB::table('instansi')->where('id_instansi', $id_instansi)->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

    }
    public function editdata_instansi($id_instansi){
        $instansi = DB::table('instansi')
                    ->where('id_instansi',$id_instansi)
                    ->first();
        return view("data_instansi.editdata",compact("instansi"));
    }
    public function updatedata_instansi(Request $request){
        $id_instansi = $request->id_instansi;
        $nama_instansi = $request->nama_instansi ;
        $alamat_instansi = $request->alamat_instansi;
        $contact_instansi = $request->contact_instansi;
        $data=[
            'nama_instansi' => $nama_instansi ,
            'alamat_instansi' => $alamat_instansi,
            'contact_instansi' => $contact_instansi

        ];
        $update = DB::table('instansi')->where('id_instansi',$id_instansi)->update($data);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['error'=> 'Data Gagal Di Update']);
        }

    }

}
