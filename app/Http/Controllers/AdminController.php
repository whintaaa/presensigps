<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index(Request $request){
        $query = DB::table('users');
        $query->select('*');
        $query->orderBy('name');
        if(!empty($request->name)){
            $query->where('name','like','%'.$request->name.'%');
        }
        $datauser= $query->paginate(2);
        return view("data_user.index",compact("datauser"));
    }
    public function simpandata_user(Request $request){
        $name = $request->name ;
        $email_admin = $request->email_admin;
        $departement = $request->departement;
        $password = Hash::make($request->password);
        $data=[
            'name' => $name ,
            'email_admin' => $email_admin,
            'departement' => $departement,
            'password' => $password

        ];
        $cek = DB::table("users")->where('email_admin',$email_admin)->count();
        if($cek == 0){
            $simpan = DB::table('users')->insert($data);
            if($simpan){
                return Redirect::back()->with(['success' => 'Data telah ditambahkan']);
            }else{
                return Redirect::back()->with(['error'=> 'Hubungi Tim IT']);
            }
        }else{
            return Redirect::back()->with(['error'=> 'Email Sudah Terdaftar']);
        }
    }
    public function hapusDatauser($id)
    {
        $id_admin = Auth::guard('user')->user()->id;

        if ($id_admin == $id) {
            return redirect()->back()->with('error', 'Data tidak bisa dihapus');
        }

        $exists = DB::table('users')->where('id', $id)->exists();

        if ($exists) {
            DB::table('users')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

    }
    public function editdata_user($id){
        $users = DB::table('users')
                    ->where('id',$id)
                    ->first();
        return view("data_user.editdata",compact("users"));
    }
    public function updatedata_user(Request $request){
        $id = $request->id;
        $name = $request->name;
        $email_admin = $request->email_admin;
        $departement = $request->departement;
        $password = Hash::make($request->password);
        if(empty($request->password)){
            $data =[
                'name'=> $name,
                'email_admin'=> $email_admin,
                'departement'=> $departement
            ];
        }else{
            $data =[

                'name'=> $name,
                'email_admin'=> $email_admin,
                'departement'=> $departement,
                'password' => $password
            ];
        }

        $update = DB::table('users')->where('id',$id)->update($data);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['error'=> 'Data Gagal Di Update']);
        }
    }

}
