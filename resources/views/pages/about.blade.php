@extends('layouts.guest.app')

@section('content')
<div class="container">
    <h1><i data-feather="info"></i> Tentang Sistem Kami</h1>

    <p>Sistem ini bertujuan untuk memudahkan administrasi warga dan peminjaman fasilitas.</p>

    <h2>Tujuan</h2>
    <ul>
        <li>Mengelola data warga secara digital</li>
        <li>Mempermudah proses peminjaman fasilitas</li>
        <li>Memberikan informasi yang transparan</li>
    </ul>

    <h2>Alur Penggunaan</h2>
    <ol>
        <li>Warga mendaftar akun</li>
        <li>Login ke sistem</li>
        <li>Mengajukan peminjaman fasilitas</li>
        <li>Menunggu persetujuan admin</li>
        <li>Mendapatkan konfirmasi</li>
    </ol>

    <img src="{{ asset('images/alur-sistem.jpg') }}" alt="Alur Sistem" style="max-width: 100%;">
</div>
@endsection
