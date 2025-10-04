<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 0; }
        header { background: #2c3e50; color: white; padding: 15px; }
        header h1 { margin: 0; }
        .container { padding: 20px; }
        .card { display: inline-block; width: 200px; background: white; padding: 15px; margin: 10px; border-radius: 8px; box-shadow: 0px 2px 5px rgba(0,0,0,0.1); text-align: center; }
        .card h2 { margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; border-radius: 8px; overflow: hidden; }
        table th, table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        table th { background: #3498db; color: white; }
    </style>
</head>
<body>

    <header>
        <h1>Dashboard Admin</h1>
    </header>

    <div class="container">
        <h2>Ringkasan Data</h2>
        <div class="card">
            <h3>Total Fasilitas</h3>
            <h2>{{ $total_fasilitas }}</h2>
        </div>
        <div class="card">
            <h3>Total Peminjaman</h3>
            <h2>{{ $total_peminjaman }}</h2>
        </div>
        <div class="card">
            <h3>Total Pembayaran</h3>
            <h2>{{ $total_pembayaran }}</h2>
        </div>
        <div class="card">
            <h3>Total Petugas</h3>
            <h2>{{ $total_petugas }}</h2>
        </div>

        <h2>Peminjaman Terbaru</h2>
        <table>
            <tr>
                <th>ID Pinjam</th>
                <th>Fasilitas</th>
                <th>Tujuan</th>
                <th>Status</th>
            </tr>
            @foreach($recent_peminjaman as $p)
            <tr>
                <td>{{ $p['pinjam_id'] }}</td>
                <td>{{ $p['fasilitas'] }}</td>
                <td>{{ $p['tujuan'] }}</td>
                <td>{{ $p['status'] }}</td>
            </tr>
            @endforeach
        </table>
    </div>

</body>
</html>
