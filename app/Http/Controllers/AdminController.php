<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
        $total_fasilitas   = 5;
        $total_peminjaman  = 12;
        $total_pembayaran  = 10;
        $total_petugas     = 3;

        $recent_peminjaman = [
            ['pinjam_id' => 101, 'fasilitas' => 'Balai Desa', 'tujuan' => 'Pernikahan', 'status' => 'Disetujui'],
            ['pinjam_id' => 102, 'fasilitas' => 'Lapangan Bola', 'tujuan' => 'Turnamen Bola', 'status' => 'Menunggu'],
            ['pinjam_id' => 103, 'fasilitas' => 'Aula', 'tujuan' => 'Rapat Warga', 'status' => 'Ditolak'],
        ];

        return view('dashboard', compact(
            'total_fasilitas',
            'total_peminjaman',
            'total_pembayaran',
            'total_petugas',
            'recent_peminjaman'
        ));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
