<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi_pkl extends Model
{
    protected $fillable = [
        'nama_lokasi',
        'alamat_lokasi',
        'lat_long'
    ];
    use HasFactory;
}
