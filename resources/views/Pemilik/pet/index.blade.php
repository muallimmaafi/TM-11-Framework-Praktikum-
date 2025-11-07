<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pet</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <main>
            <header>
                <h2>Halo, Admin</h2>
                <p>Selamat Datang di Dashboard Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
            </header>

            <section class="list">
                <h3>Daftar Pet</h3>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pet</th>
                            <th>Tanggal Lahir</th>
                            <th>Warna/Tanda</th>
                            <th>Jenis Kelamin</th>
                            <th>Pemilik</th>
                            <th>Ras Hewan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pet as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->tanggal_lahir }}</td>
                            <td>{{ $p->warna_tanda }}</td>
                            <td>{{ ucfirst($p->jenis_kelamin) }}</td>
                            <td>{{ $p->pemilik->nama_pemilik ?? '-' }}</td>
                            <td>{{ $p->rasHewan->nama_ras ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>