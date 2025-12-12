<?php

namespace Database\Seeders;

use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua peminjaman yang berbayar (total_biaya > 0)
        $peminjamanList = PeminjamanFasilitas::where('total_biaya', '>', 0)->get();

        foreach ($peminjamanList as $pinjam) {
            
            // Kita buat skenario: 80% peminjaman sudah dibayar
            if ($faker->boolean(80)) {
                
                // Cek safety: Pastikan belum ada pembayaran untuk ID ini (karena one-to-one)
                if (PembayaranFasilitas::where('pinjam_id', $pinjam->pinjam_id)->exists()) {
                    continue;
                }

                // Tentukan tanggal bayar (antara waktu booking dibuat s/d tanggal sewa dimulai)
                // Fallback: kalau created_at null, pakai hari ini
                $startObj = $pinjam->created_at ?? now();
                // Pastikan start tidak lebih besar dari end (tanggal_mulai)
                if ($startObj > $pinjam->tanggal_mulai) {
                    $tglBayar = $pinjam->tanggal_mulai; 
                } else {
                    $tglBayar = $faker->dateTimeBetween($startObj, $pinjam->tanggal_mulai);
                }

                PembayaranFasilitas::create([
                    'pinjam_id'  => $pinjam->pinjam_id,
                    'tgl_bayar'  => $tglBayar,
                    'jumlah'     => $pinjam->total_biaya, // Bayar Lunas
                    'metode'     => $faker->randomElement(['Tunai', 'Transfer BRI', 'Transfer BCA', 'Transfer Mandiri', 'E-Wallet Dana', 'E-Wallet Gopay', 'QRIS']),
                    'keterangan' => $faker->optional(0.5)->sentence, // 50% ada keterangan
                ]);

                // Update status peminjaman jadi 'disetujui' jika sudah bayar
                // Kecuali yang statusnya sudah 'selesai', jangan diubah jadi 'disetujui' mundur
                if ($pinjam->status == 'pending') {
                    $pinjam->update(['status' => 'disetujui']);
                }
            }
        }

        $this->command->info('Sukses! Data Pembayaran dummy berhasil digenerate.');
    }
}