<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Resepsionis</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <aside>
            <h1>Rumah Sakit Hewan Pendidikan Universitas Airlangga</h1>
            <nav>
                <ul>
                    <li><a href="{{ route('admin.jenis-hewan.index') }}"><i class="bi bi-list-ul"></i> Daftar Jenis Hewan</a></li>
                    <li><a href="{{ route('admin.ras-hewan.index') }}"><i class="bi bi-tags"></i> Daftar Ras Hewan</a></li>
                    <li><a href="{{ route('admin.kategori.index') }}"><i class="bi bi-grid"></i> Daftar Kategori</a></li>
                    <li><a href="{{ route('admin.kategori-klinis.index') }}"><i class="bi bi-heart-pulse"></i> Daftar Kategori Klinis</a></li>                    
                    <li><a href="{{ route('admin.kode-tindakan-terapi.index') }}"><i class="bi bi-capsule"></i> Kode Tindakan Terapi</a></li>
                    <li><a href="{{ route('admin.pet.index') }}"><i class="bi bi-heart"></i> Daftar Pet</a></li>
                    <li><a href="{{ route('admin.role.index') }}"><i class="bi bi-person-badge"></i> Daftar Role</a></li>
                    <li><a href="{{ route('admin.user.index') }}"><i class="bi bi-people"></i> Daftar User</a></li>
                    <li><a href="{{ route('admin.pemilik.index') }}"><i class="bi bi-person"></i> Daftar Pemilik</a></li>
                </ul>
            </nav>
        </aside>

        <main>
            <header>
                <h2>Halo, Resepsionis</h2>
                <p>Selamat Datang di Dashboard Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
            </header>
        </main>
    </div>
</body>
</html>