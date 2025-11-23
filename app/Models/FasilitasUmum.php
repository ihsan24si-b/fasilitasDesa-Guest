<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function syaratFasilitas()
    {
        return $this->hasMany(SyaratFasilitas::class, 'fasilitas_id');
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
    }

    // Scope untuk filter
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['jenis']) && $filters['jenis']) {
            $query->where('jenis', $filters['jenis']);
        }

        if (isset($filters['rt']) && $filters['rt']) {
            $query->where('rt', $filters['rt']);
        }

        if (isset($filters['rw']) && $filters['rw']) {
            $query->where('rw', $filters['rw']);
        }

        return $query;
    }
}
