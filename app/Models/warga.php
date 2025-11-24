<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    protected $fillable = [
        'no_ktp',
        'nama_lengkap',    // UBAH: dari 'nama'
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'no_telepon',      // UBAH: dari 'telp'
        'email',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('nama_lengkap', 'like', "%{$search}%")  // UBAH: dari 'nama'
                    ->orWhere('no_ktp', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_telepon', 'like', "%{$search}%")   // UBAH: dari 'telp'
                    ->orWhere('pekerjaan', 'like', "%{$search}%");
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['jenis_kelamin']) && $filters['jenis_kelamin']) {
            $query->where('jenis_kelamin', $filters['jenis_kelamin']);
        }

        if (isset($filters['agama']) && $filters['agama']) {
            $query->where('agama', $filters['agama']);
        }

        if (isset($filters['pekerjaan']) && $filters['pekerjaan']) {
            $query->where('pekerjaan', 'like', "%{$filters['pekerjaan']}%");
        }

        return $query;
    }
}
