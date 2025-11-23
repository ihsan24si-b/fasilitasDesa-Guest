<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Warga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('no_ktp', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telp', 'like', "%{$search}%");
    }

    // Scope untuk filter
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
