<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PresensiController extends Controller
{
    public function create(){
        $hariini = date("Y-m-d");
        $id_pkl = Auth::guard('data_magang')->user()->id_pkl;
        $cek = DB::table("presensi")->where('tgl_presensi',$hariini)->where('id_pkl',$id_pkl)->count();
        $data=DB::table('data_magang')
        ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi')
        ->where('id_pkl',$id_pkl)
        ->first();
        $lat_long = $data->lat_long;
        $pisah = explode(', ', $lat_long);
        $lat = floatval($pisah[0]);
        $long = floatval($pisah[1]);

        return view('presensi.create', compact('cek','lat','long'));
    }

    public function store(Request $request){
        $id_pkl = Auth::guard('data_magang')->user()->id_pkl;
        $data=DB::table('data_magang')
        ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi')
        ->join('instansi','instansi.id_instansi','=','data_magang.id_instansi')
        ->where('id_pkl',$id_pkl)
        ->first();
        $nama_lengkap=$data->nama_lengkap;
        $email = $data->email;
        $nmr_induk=$data->nmr_induk;
        $nama_instansi=$data->nama_instansi;
        $tgl_presensi = $request->tgl_presensi;
        $jam = date("H:i:s");
        $lokasi = $request->lokasi;
        $lokuser= explode(",",$lokasi);
        $latitudeuser =$lokuser[0];
        $longitudeuser =$lokuser[1];
        $pisah = explode(', ', $data->lat_long);
        $latkantor = floatval($pisah[0]);
        $longkantor = floatval($pisah[1]);
        $jarak = $this->distance($latkantor,$longkantor,$latitudeuser,$longitudeuser);
        $radius = round($jarak['meters']);
        $aktivitas = $request->aktivitas;
        $alasan_terlambat = $request->alasan_terlambat;
        $cek = DB::table("presensi")->where('tgl_presensi',$tgl_presensi)->where('id_pkl',$id_pkl)->count();
        if($radius > 150){
            echo "error|Maaf Anda Berada Diluar Radius|";
        }else{
            if($cek > 0){
                $data_pulang = [
                    'jam_out' => $jam,
                    'lokasi_out' => $lokasi
                ];
                $update= DB::table("presensi")->where('tgl_presensi',$tgl_presensi)->where('id_pkl',$id_pkl)-> update($data_pulang);
                if($update){
                    echo "success|Absen keluar anda sudah terekam|out";
                }else{
                    echo "error|Maaf terjadi kesalahan, Hubungi tim IT|out";
                }
            }else{
                $data = [
                    'id_pkl' => $id_pkl,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'lokasi_in' => $lokasi,
                    'aktivitas' => $aktivitas,
                    'alasan_terlambat' => $alasan_terlambat
                ];
                $simpan = DB::table('presensi')->insert($data);
                if($simpan){
                    $content = "Terima kasih, Anda telah melakukan daftar kehadiran dengan detail berikut:<br><br>" .
                        "ID PKL/MAGANG: PKL{$id_pkl}<br>NIS: {$nmr_induk}<br>Nama: {$nama_lengkap}<br>Asal Instansi: {$nama_instansi}<br>Tanggal & Jam kehadiran: {$tgl_presensi} {$jam}<br><br>" .
                        "note:<br>1. Lakukan Absensi kehadiran setiap hari sebagai bukti kehadiran Siswa/i atau Mahasiswa/i selama PKL di PT.Sanggar Sarana Baja<br>" .
                        "2. Bagi Siswa/i atau Mahasiswa/i yang berhalangan hadir(izin/sakit/dll) dimohon melakukan pengajuan izin.<br><br>" .
                        "SSB KARYA - KINERJA - JUARA!<br>" .
                        "Ini adalah kotak suara yang tidak dipantau.<br> Mohon tidak membalas email ini<br><br><br>";

                    $response = Http::get("https://prod-56.southeastasia.logic.azure.com/workflows/cb901ae63ce04655bc14b91078e05115/triggers/manual/paths/invoke", [
                        'api-version' => '2016-06-01',
                        'sp' => '/triggers/manual/run',
                        'sv' => '1.0',
                        'sig' => 'uR_gyZ06m8dPJVtr5Y0smZ82Ghr5-h1Ddycru2eCoFE',
                        'to' => $email,
                        'sub' => "Notifikasi Kehadiran Magang {$nama_lengkap}/{$tgl_presensi}",
                        'temp' => $content
                    ]);

                    echo "success|Absen masuk anda sudah terekam|in";
                }else{
                    echo "error|Maaf terjadi kesalahan, Hubungi tim IT|in";
                }
            }
        }
    }
    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editprofile(){
        $id_pkl = Auth::guard('data_magang')->user()->id_pkl;
        $datadiri = DB::table('data_magang')
                            ->join('divisi','divisi.id_divisi','=','data_magang.id_divisi')
                            ->join('pembimbing','pembimbing.id_pl','=','data_magang.id_pl')
                            ->join('instansi','instansi.id_instansi','=','data_magang.id_instansi')
                            ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi')
                            ->where('id_pkl',$id_pkl)
                            ->first();
        $data_divisi = DB::table('divisi')->get();
        $data_pl = DB::table('pembimbing')->get();
        $data_instansi = DB::table('instansi')->get();
        $data_lokasi = DB::table('lokasi_pkl')->get();
        return view('presensi.editprofile', compact('datadiri','data_divisi','data_pl','data_instansi','data_lokasi'));
    }
    public function updateprofile(Request $request){
        $id_pkl = Auth::guard('data_magang')->user()->id_pkl;
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

    public function histori(){
        $namabulan=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $thnpresensi = DB::table('presensi')
        ->select(DB::raw('YEAR(tgl_presensi) as tahun'))
        ->groupBy('tahun')
        ->orderBy('tahun')
        ->first();
        $thnpresensi= $thnpresensi ? $thnpresensi-> tahun : null;
        return view('presensi.histori' ,compact('namabulan','thnpresensi'));
    }
    public function gethistori(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $id_pkl = Auth::guard('data_magang')->user()->id_pkl;

        $histori = DB::table('presensi')
                    ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
                    ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
                    ->where('id_pkl', $id_pkl)
                    ->orderBy('tgl_presensi')
                    ->get();
        $namabulan=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        return view('presensi.gethistori', compact('histori','namabulan'));
    }
    public function detailhistori($tgl){
        $hari = $tgl;
        $hariini = '"' . $hari . '"';
        $id_pkl = Auth::guard('data_magang')->user()->id_pkl;
        $datadiri = DB::table('presensi')
                            ->join('data_magang','data_magang.id_pkl','=','presensi.id_pkl')
                            ->join('divisi','divisi.id_divisi','=','data_magang.id_divisi')
                            ->join('pembimbing','pembimbing.id_pl','=','data_magang.id_pl')
                            ->join('instansi','instansi.id_instansi','=','data_magang.id_instansi')
                            ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi')
                            ->where('presensi.id_pkl',$id_pkl)
                            ->first();
        $presensihariini = DB::table('presensi')
                            ->where('id_pkl',$id_pkl)
                            ->where('tgl_presensi',$hari)
                            ->first();
        $namabulan=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        return view('presensi.detailhistori', compact('datadiri','presensihariini','namabulan'));
    }
    public function izin(){
        $id_pkl = Auth::guard('data_magang')->user()->id_pkl;
        $izin =DB::table('pengajuan_izin')
                ->where('id_pkl',$id_pkl)
                ->orderBy('tgl_izin','desc')
                ->get();
        $namabulan=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        return view('presensi.izin',compact('izin','namabulan'));
    }
    public function formizin(){
        return view('presensi.formizin');
    }
    public function storeIzin(Request $request)
    {
        $id_pkl = Auth::guard('data_magang')->user()->id_pkl;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $ket_izin = $request->ket_izin;

        $datadiri = DB::table('data_magang')
                        ->join('pembimbing', 'pembimbing.id_pl', '=', 'data_magang.id_pl')
                        ->where('id_pkl', $id_pkl)
                        ->first();
        $nama_pl = $datadiri->nama_pl;
        $email_pl = $datadiri->email_pl;
        $nama_lengkap = $datadiri->nama_lengkap;

        $data = [
            "id_pkl" => $id_pkl,
            "tgl_izin" => $tgl_izin,
            "status" => $status,
            "ket_izin" => $ket_izin,
        ];
        switch ($status) {
            case 'i':
                $statuss = 'izin';
                break;
            case 's':
                $statuss = 'sakit';
                break;
            default:
                $statuss = 'tidak diketahui';
                break;
        }
        $simpan = DB::table('pengajuan_izin')->insert($data);

        if ($simpan) {
            $content = "Kepada Yth. Bapak/Ibu Pembimbing,{$nama_pl}<br><br>" .
                        "Berikut adalah pengajuan izin,<br><br>" .
                        "Dari Mahasiswa/Siswa PKL dengan nama {$nama_lengkap}, mengajukan izin {$statuss} pada tanggal {$tgl_izin} dengan alasan sebagai berikut: {$ket_izin}.<br><br>" .
                        "Terima kasih atas perhatiannya.<br><br>" .
                        "SSB KARYA - KINERJA - JUARA!\n" .
                        "Ini adalah kotak suara yang tidak dipantau.\n Mohon tidak membalas email ini<br><br><br>";

            $response = Http::get("https://prod-56.southeastasia.logic.azure.com/workflows/cb901ae63ce04655bc14b91078e05115/triggers/manual/paths/invoke", [
                'api-version' => '2016-06-01',
                'sp' => '/triggers/manual/run',
                'sv' => '1.0',
                'sig' => 'uR_gyZ06m8dPJVtr5Y0smZ82Ghr5-h1Ddycru2eCoFE',
                'to' => $email_pl,
                'sub' => "Notifikasi Pengajuan Izin Tidak Hadir Magang {$nama_lengkap}/{$tgl_izin}",
                'temp' => $content
            ]);
            if ($response->successful()) {
                DB::table('pengajuan_izin')
                    ->where('id_pkl', $id_pkl)
                    ->where('tgl_izin', $tgl_izin)
                    ->update(['status_approved' => 1]);
                }
            return Redirect::back()->with(['success' => 'Pengajuan izin anda sudah terekam']);
        } else {
            return Redirect::back()->with(['error' => 'Gagal mengajukan izin']);
        }
    }
    public function approved(Request $request){
        $id_pkl = $request->id;
        $tgl_izin = $request->tgl_izin;
        $status_approved = $request->approved;

        $update = DB::table('pengajuan_izin')
                    ->where('id_pkl', $id_pkl)
                    ->where('tgl_izin', $tgl_izin)
                    ->update([
                        'status_approved' => $status_approved
                    ]);
    }

    public function monitoring(){
        return view('presensi.monitoring');
    }
    public function getpresensi(Request $request){
        $tanggal = $request->tanggal;
        $getpresensi=DB::table('presensi')
                    ->join('data_magang','data_magang.id_pkl','=','presensi.id_pkl')
                    ->join('divisi','divisi.id_divisi','=','data_magang.id_divisi')
                    ->join('instansi','instansi.id_instansi','=','data_magang.id_instansi')
                    ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi')
                    ->where('tgl_presensi',$tanggal)
                    ->get();
        $getizin=DB::table('pengajuan_izin')
                    ->join('data_magang','data_magang.id_pkl','=','pengajuan_izin.id_pkl')
                    ->join('divisi','divisi.id_divisi','=','data_magang.id_divisi')
                    ->join('instansi','instansi.id_instansi','=','data_magang.id_instansi')
                    ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi')
                    ->where('tgl_izin',$tanggal)
                    ->where('status_approved',1)
                    ->get();

        return view('presensi.getpresensi',compact('getpresensi','getizin'));

    }
    public function presensihistori(Request $request){
        $namabulan=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $bulan=$request->bulan;
        $tahun=$request->tahun;
        $thnpresensi = DB::table('presensi')
        ->select(DB::raw('YEAR(tgl_presensi) as tahun'))
        ->groupBy('tahun')
        ->orderBy('tahun')
        ->first();
        $thnpresensi= $thnpresensi ? $thnpresensi-> tahun : null;
        $query = DB::table('presensi');
        $query->select('*');
        $query->join('data_magang','data_magang.id_pkl','=','presensi.id_pkl')
                ->join('divisi','divisi.id_divisi','=','data_magang.id_divisi')
                ->join('pembimbing','pembimbing.id_pl','=','data_magang.id_pl')
                ->join('instansi','instansi.id_instansi','=','data_magang.id_instansi')
                ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi');
        $query->orderBy('tgl_presensi','desc');
        if(!empty($request->nama_siswa)){
            $query->where('nama_lengkap','like','%'.$request->nama_siswa.'%');
        }
        if(!empty($bulan)){
            $query->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"');
        }
        if(!empty($tahun)){
            $query->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"');
        }
        if(!empty($request->nama_siswa)||!empty($bulan)||!empty($tahun)){
            $totalKehadiran = $query->count();
        }else{
            $totalKehadiran=null;
        }
        $presensihistori=$query->paginate(10);
        return view("presensi.presensihistori",compact("presensihistori","totalKehadiran","namabulan","thnpresensi"));
    }
    public function laporan(Request $request){
        $namabulan=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $thnpresensi = DB::table('presensi')
        ->select(DB::raw('YEAR(tgl_presensi) as tahun'))
        ->groupBy('tahun')
        ->orderBy('tahun')
        ->first();
        $thnpresensi= $thnpresensi ? $thnpresensi-> tahun : null;
        $id_pkl = DB::table('presensi')
        ->select('id_pkl')
        ->groupBy('id_pkl')
        ->orderBy('id_pkl')
        ->get();
        return view('presensi.laporan',compact('namabulan','thnpresensi','id_pkl'));
    }
    public function cetaklaporan(Request $request){
        $id_pkl = $request->id_pkl;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $presensi = DB::table('presensi')
                    ->join('data_magang','data_magang.id_pkl','=','presensi.id_pkl')
                    ->join('divisi','divisi.id_divisi','=','data_magang.id_divisi')
                    ->join('pembimbing','pembimbing.id_pl','=','data_magang.id_pl')
                    ->join('instansi','instansi.id_instansi','=','data_magang.id_instansi')
                    ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi')
                    ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
                    ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
                    ->where('presensi.id_pkl', $id_pkl)
                    ->orderBy('tgl_presensi')
                    ->get();
        $izin = DB::table('pengajuan_izin')
                    ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
                    ->whereRaw('YEAR(tgl_izin)="' . $tahun . '"')
                    ->where('pengajuan_izin.id_pkl', $id_pkl)
                    ->where('status_approved',1)
                    ->orderBy('tgl_izin')
                    ->get();
        $data=$presensi->first();
        if(isset($_POST['excel'])){
            $time = date("d-M-Y H:i:s");
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Presensi $data->nama_lengkap $time.xls");
        }
        return view('presensi.cetaklaporan',compact('bulan','namabulan','tahun','presensi','data','izin'));
    }
    public function rekap(Request $request){
        $namabulan=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $thnpresensi = DB::table('presensi')
        ->select(DB::raw('YEAR(tgl_presensi) as tahun'))
        ->groupBy('tahun')
        ->orderBy('tahun')
        ->first();
        $thnpresensi= $thnpresensi ? $thnpresensi-> tahun : null;

        return view('presensi.rekap',compact('namabulan','thnpresensi'));
    }
    public function cetakrekap(Request $request){
        $bulan = $request->bulan;
        $namabulan=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $tahun = $request->tahun;
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

        $presensi = DB::table('presensi')
            ->select('presensi.id_pkl', 'nama_lengkap','nama_pl');
        for ($tgl = 1; $tgl <= $daysInMonth; $tgl++) {
            $presensi->selectRaw('MAX(IF(DAY(tgl_presensi) = ' . $tgl . ', CONCAT(jam_in), "")) as tgl_' . $tgl);
        }
        $presensi->join('data_magang', 'data_magang.id_pkl', '=', 'presensi.id_pkl')
            ->join('pembimbing','pembimbing.id_pl','=','data_magang.id_pl')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->groupByRaw('presensi.id_pkl,nama_lengkap,nama_pl');
        $rekaphadir = $presensi->get();
        $izin = DB::table('pengajuan_izin')
            ->select('pengajuan_izin.id_pkl', 'nama_lengkap');
        for ($tgl = 1; $tgl <= $daysInMonth; $tgl++) {
            $izin->selectRaw('MAX(IF(DAY(tgl_izin) = ' . $tgl . ', status, "")) as izin_' . $tgl);
        }
        $izin->join('data_magang', 'data_magang.id_pkl', '=', 'pengajuan_izin.id_pkl')
            ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_izin)="' . $tahun . '"')
            ->where('status_approved',1)
            ->groupByRaw('pengajuan_izin.id_pkl,nama_lengkap');
        $rekapizin = $izin->get();
        if(isset($_POST['excel'])){
            $time = date("d-M-Y H:i:s");
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Rekap Presensi Internship $time.xls");
        }
        return view('presensi.cetakrekap',compact('bulan','namabulan','tahun','rekaphadir','rekapizin','daysInMonth'));
   }
    public function dataizin(Request $request){
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $thnizin = DB::table('pengajuan_izin')
        ->select(DB::raw('YEAR(tgl_izin) as tahun'))
        ->groupBy('tahun')
        ->orderBy('tahun')
        ->first();
        $thnizin= $thnizin ? $thnizin-> tahun : null;
        $query = DB::table('pengajuan_izin');
        $query->select('*');
        $query->join('data_magang','data_magang.id_pkl','=','pengajuan_izin.id_pkl')
                ->join('divisi','divisi.id_divisi','=','data_magang.id_divisi')
                ->join('pembimbing','pembimbing.id_pl','=','data_magang.id_pl')
                ->join('instansi','instansi.id_instansi','=','data_magang.id_instansi')
                ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi');
        if(!empty($request->nama_siswa)){
            $query->where('nama_lengkap','like','%'.$request->nama_siswa.'%');
        }
        if(!empty($bulan)){
            $query->whereRaw('MONTH(tgl_izin)="' . $bulan . '"');
        }
        if(!empty($tahun)){
            $query->whereRaw('YEAR(tgl_izin)="' . $tahun . '"');
        }
        $query->orderBy('tgl_izin','desc');
        $dataizin= $query->paginate(2);
        $divisi = DB::table('divisi')
                    ->get();
        $pembimbing = DB::table('pembimbing')
        ->get();
        $instansi = DB::table('instansi')
                    ->get();
        $lokasi_pkl = DB::table('lokasi_pkl')
                    ->get();
    return view('presensi.dataizin',compact('dataizin','divisi','lokasi_pkl','namabulan','thnizin'));
   }
   public function cetakizin(Request $request){
        $bulan = $request->bulan;
        $namabulan=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $tahun = $request->tahun;
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $izin = DB::table('pengajuan_izin')
            ->select('pengajuan_izin.id_pkl', 'nama_lengkap');
        for ($tgl = 1; $tgl <= $daysInMonth; $tgl++) {
            $izin->selectRaw('MAX(IF(DAY(tgl_izin) = ' . $tgl . ', status, "")) as izin_' . $tgl);
        }
        $izin->join('data_magang', 'data_magang.id_pkl', '=', 'pengajuan_izin.id_pkl')
            ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_izin)="' . $tahun . '"')
            ->where('status_approved',1)
            ->groupByRaw('pengajuan_izin.id_pkl,nama_lengkap');
        $rekapizin = $izin->get();
        if(isset($_POST['excel'])){
            $time = date("d-M-Y H:i:s");
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Rekap Data Izin Internship $time.xls");
        }
    return view('presensi.cetakizin',compact('bulan','namabulan','tahun','rekapizin','daysInMonth'));
    }
    public function izinapproved(Request $request){
        $id_izin = $request->id_sakit;
        $status_approved=$request->status_approved;
        $update = DB::table('pengajuan_izin')
                    ->where('id_izin',$id_izin)
                    ->update([
                        'status_approved'=> $status_approved
                    ]);
        if($update){
            return Redirect::back()->with(['success' => 'Data telah diupdate']);
        }else{
            return Redirect::back()->with(['error'=> 'Hubungi Tim IT']);
        }
    }
    public function batalapproved($id){
        $update = DB::table('pengajuan_izin')
                    ->where('id_izin',$id)
                    ->update([
                        'status_approved'=> 0
                    ]);
        if($update){
            return Redirect::back()->with(['success' => 'Data telah diupdate']);
        }else{
            return Redirect::back()->with(['error'=> 'Hubungi Tim IT']);
        }
    }
}
