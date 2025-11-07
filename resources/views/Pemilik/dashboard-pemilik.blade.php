<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <aside>
            <h1>Rumah Sakit Hewan Pendidikan Universitas Airlangga</h1>
            <nav>
                <ul>
                    <li><a href="{{ route('admin.pet.index') }}"><i class="bi bi-heart"></i> Daftar Pet</a></li>
                </ul>
            </nav>
        </aside>

        <main>
            <header>
                <h2>Halo, Pemilik</h2>
                <p>Selamat Datang di Dashboard Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
            </header>
        </main>
    </div>
</body>
</html>