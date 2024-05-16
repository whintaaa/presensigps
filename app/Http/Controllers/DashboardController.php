<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hari = date("Y-m-d");
        $bulan = date("m");
        $tahun = date("Y");
        $hariini = '"' . $hari . '"';
        $id_pkl = Auth::guard('data_magang')->user()->id_pkl;
        $datadiri = DB::table('data_magang')
                            ->join('divisi','divisi.id_divisi','=','data_magang.id_divisi')
                            ->join('pembimbing','pembimbing.id_pl','=','data_magang.id_pl')
                            ->join('instansi','instansi.id_instansi','=','data_magang.id_instansi')
                            ->join('lokasi_pkl','lokasi_pkl.id_lokasi','=','data_magang.id_lokasi')
                            ->where('data_magang.id_pkl',$id_pkl)
                            ->first();
        $presensihariini = DB::table('presensi')
                            ->where('id_pkl',$id_pkl)
                            ->where('tgl_presensi',$hari)
                            ->first();
        $historibulanini = DB::table('presensi')
                            ->where('id_pkl',$id_pkl)
                            ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
                            ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
                            ->orderBy('tgl_presensi')
                            ->get();
        $rekapbulanini =DB::table('presensi')
                            ->selectRaw('COUNT(id_pkl) as jmlhadir, SUM(IF(jam_in > "08:00",1,0)) as jmltelat')
                            ->where('id_pkl',$id_pkl)
                            ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
                            ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
                            ->first();
        $izinbulanini =DB::table('pengajuan_izin')
                            ->selectRaw('SUM(IF(status = "s",1,0)) as jmlsakit, SUM(IF(status = "i",1,0)) as jmlizin')
                            ->where('id_pkl',$id_pkl)
                            ->where('status_approved',1)
                            ->whereRaw('MONTH(tgl_izin)="'.$bulan.'"')
                            ->whereRaw('YEAR(tgl_izin)="'.$tahun.'"')
                            ->first();

        $namabulan=["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $bulantahun=$namabulan[$bulan*1]." ".$tahun;
        return view('dashboard.dashboard', compact('datadiri','presensihariini','historibulanini','bulantahun','namabulan','rekapbulanini','izinbulanini'));
    }
    public function viewpresensi(){
        $hari = date("Y-m-d");
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
        return view('dashboard.viewpresensi', compact('datadiri','presensihariini','namabulan'));
    }
    public function detailpresensi($tgl){
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
        return view('dashboard.viewpresensi', compact('datadiri','presensihariini','namabulan'));
    }
    public function dashboardadmin(){
        $hari = date("Y-m-d");
        $bulan = date("m");
        $tahun = date("Y");
        $hariini = '"' . $hari . '"';
        $jmlhuser = DB::table('data_magang')
                    ->selectRaw('COUNT(id_pkl) as jmlh')
                    ->first();
        $rekaphariini =DB::table('presensi')
                    ->selectRaw('COUNT(id_pkl) as jmlhadir, COUNT(IF(jam_in > "08:00",1,0)) as jmltelat')
                    ->where('tgl_presensi',$hari)
                    ->first();
        $rekapizin = DB::table('pengajuan_izin')
                    ->selectRaw('SUM(IF(status="i", 1, 0)) as jmlizin, SUM(IF(status="s", 1, 0)) as jmlsakit')
                    ->where('tgl_izin', $hari)
                    ->where('status_approved', 1)
                    ->first();
        return view('dashboard.dashboardadmin',compact('jmlhuser','rekaphariini','rekapizin'));
    }
}
