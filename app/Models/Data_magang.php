<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Data_magang extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "data_magang";
    protected $primaryKey = "id_pkl";
    protected $fillable = [
        'id_pkl',
        'nama_lengkap',
        'nmr_induk',
        'email',
        'no_hp',
        'password',
        'id_divisi',
        'id_pl',
        'id_instansi',
        'id_lokasi',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
