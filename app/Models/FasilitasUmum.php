<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasilitasUmum extends Model
{
    protected $table = 'fasilitas_umum';
    protected $primaryKey = 'fasilitas_id';
    protected $fillable = [
        'nama',
        'jenis',
        'alamat',
        'rt',
        'rw',
        'kapasitas',
        'deskripsi',
    ];

    // TAMBAHKAN RELASI INI
    public function syaratFasilitas()
    {
        return $this->hasMany(SyaratFasilitas::class, 'fasilitas_id');
    }
}
