<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranFasilitas extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_fasilitas';
    protected $primaryKey = 'bayar_id';

    protected $fillable = [
        'pinjam_id',
        'tgl_bayar',
        'jumlah',
        'metode',
        'keterangan',
    ];

    protected $casts = [
        'tgl_bayar' => 'date',
    ];

    // Relasi ke Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanFasilitas::class, 'pinjam_id', 'pinjam_id');
    }

    // Relasi ke Media (Resi)
    public function media()
    {
        return $this->hasOne(Media::class, 'ref_id', 'bayar_id')
                    ->where('ref_table', 'pembayaran_fasilitas');
    }
}