<?php

namespace App\Http\Controllers;

use App\Models\Data_magang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class Data_magangController extends Controller
{
    public function index(Request $request){
        $query = Data_magang::query();
        $query->select('*');
        $query->join('divisi','divisi.id_divisi','=','data_magang.id_divisi')
                ->join('pembimbing','pembimbing.id_pl','=','data_magang.id_pl')
                ->join('instansi','instansi.id_instansi','=','data_magang.id_instansi')
                ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi');
        $query->orderBy('id_pkl');
        if(!empty($request->nama_siswa)){
            $query->where('nama_lengkap','like','%'.$request->nama_siswa.'%');
        }
        if(!empty($request->kode_dept)){
            $query->where('data_magang.id_divisi',$request->kode_dept);
        }
        if(!empty($request->kode_lok)){
            $query->where('data_magang.id_lokasi',$request->kode_lok);
        }
        $datadiri= $query->paginate(2);
        $divisi = DB::table('divisi')
                    ->get();
        $pembimbing = DB::table('pembimbing')
        ->get();
        $instansi = DB::table('instansi')
                    ->get();
        $lokasi_pkl = DB::table('lokasi_pkl')
                    ->get();
        return view("data_magang.index",compact("datadiri","divisi","lokasi_pkl","pembimbing","instansi"));
    }
    public function simpandata(Request $request){
        $id_pkl = $request->id_pkl;
        $nama_lengkap = $request->nama_lengkap;
        $nmr_induk = $request->nmr_induk;
        $id_instansi = $request->id_instansi;
        $email = $request->email;
        $no_hp = $request->no_hp;
        $id_divisi = $request->id_divisi;
        $id_pl = $request->id_pl;
        $id_lokasi = $request->id_lokasi;
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
                return Redirect::back()->with(['success' => 'Data telah ditambahkan']);
            }else{
                return Redirect::back()->with(['error'=> 'Hubungi Tim IT']);
            }
        }else{
            return Redirect::back()->with(['error'=> ' ID_PKL Sudah Ada']);
        }
    }
    public function detaildata($id_pkl){
        $datadiri = DB::table('data_magang')
                            ->join('divisi','divisi.id_divisi','=','data_magang.id_divisi')
                            ->join('pembimbing','pembimbing.id_pl','=','data_magang.id_pl')
                            ->join('instansi','instansi.id_instansi','=','data_magang.id_instansi')
                            ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi')
                            ->where('id_pkl',$id_pkl)
                            ->first();
        //mengirim hasil
        return response()->json($datadiri);
    }
    public function hapusDataMagang($id_pkl)
    {
        $cek = DB::table("presensi")->where('id_pkl',$id_pkl)->count();

        // Jika ada presensi, berikan pesan error dan kembalikan
        if ($cek > 0) {
            return redirect()->back()->with('error', 'Data tidak bisa dihapus karena sudah pernah dipresensi.');
        }

        $dataMagang = Data_magang::find($id_pkl);

        // Periksa apakah data ditemukan
        if ($dataMagang) {
            $dataMagang->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

    }
    public function editdata($id_pkl){
        $datadiri = DB::table('data_magang')
                            ->join('divisi','divisi.id_divisi','=','data_magang.id_divisi')
                            ->join('pembimbing','pembimbing.id_pl','=','data_magang.id_pl')
                            ->join('instansi','instansi.id_instansi','=','data_magang.id_instansi')
                            ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi')
                            ->where('id_pkl',$id_pkl)
                            ->first();
        $divisi = DB::table('divisi')->get();
        $pembimbing = DB::table('pembimbing')->get();
        $instansi = DB::table('instansi')->get();
        $lokasi_pkl = DB::table('lokasi_pkl')->get();
        return view("data_magang.editdata",compact("datadiri","divisi","lokasi_pkl","pembimbing","instansi"));
    }
    public function updatedata_magang(Request $request){
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
        if(empty($request->password)){
            $data =[
                'nama_lengkap'=> $nama_lengkap,
                'nmr_induk'=> $nmr_induk,
                'email'=> $email,
                'no_hp'=> $no_hp,
                'id_divisi'=> $id_divisi,
                'id_pl'=> $id_pl,
                'id_instansi'=> $id_instansi,
                'id_lokasi'=> $id_lokasi,
            ];
        }else{
            $data =[
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
        }

        $update = DB::table('data_magang')->where('id_pkl',$id_pkl)->update($data);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['error'=> 'Data Gagal Di Update']);
        }
    }

}
