<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanFasilitas extends Model
{
    use HasFactory;

    // Nama tabel eksplisit (opsional jika sesuai konvensi, tapi aman ditulis)
    protected $table = 'peminjaman_fasilitas';

    // Karena PK bukan 'id', wajib didefinisikan!
    protected $primaryKey = 'pinjam_id';

    // Field yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'fasilitas_id',
        'warga_id',
        'kode_booking',
        'tanggal_mulai',
        'tanggal_selesai',
        'tujuan',
        'status',
        'total_biaya',
    ];

    // Casting tipe data agar tanggal otomatis jadi Carbon Object (enak diolah di view)
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    // --- RELASI ---

    // 1 Peminjaman milik 1 Fasilitas
    public function fasilitas()
    {
        return $this->belongsTo(FasilitasUmum::class, 'fasilitas_id', 'fasilitas_id');
    }

    // 1 Peminjaman milik 1 Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }

    // 1 Peminjaman bisa punya banyak Media (Bukti Bayar, Resi, Dokumen)
    public function media()
    {
        // Parameter: Model Media, nama kolom ref_table, nama kolom ref_id
        return $this->hasMany(Media::class, 'ref_id', 'pinjam_id')
                    ->where('ref_table', 'peminjaman_fasilitas');
    }

    // Relasi 1 Peminjaman punya 1 Pembayaran (HasOne)
    public function pembayaran()
    {
        return $this->hasOne(PembayaranFasilitas::class, 'pinjam_id', 'pinjam_id');
    }
}