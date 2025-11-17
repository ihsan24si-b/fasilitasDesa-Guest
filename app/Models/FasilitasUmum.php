<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasilitasUmum extends Model
{
     protected $table = 'fasilitas_umum';

    protected $fillable = [
        'nama_fasilitas','jenis_fasilitas','rt','rw',
        'kapasitas','alamat','deskripsi'
    ];

    public function warga()
    {
        return $this->hasMany(Warga::class, 'fasilitas_id');
    }
}
