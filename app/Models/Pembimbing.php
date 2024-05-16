<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    protected $fillable = [
        'nama_pl',
        'email_pl',
        'id_divisi'
    ];
    use HasFactory;
}
