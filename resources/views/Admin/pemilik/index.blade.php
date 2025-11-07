<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pemilik</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
                </ul>
            </nav>
        </aside>

        <main>
            <header>
                <h2>Halo, Admin</h2>
                <p>Selamat Datang di Dashboard Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
            </header>

            <section class="list">
                <h3>Daftar Pemilik</h3>
                <div class="mb-3">
                    <form action="{{ route('admin.pemilik.create') }}" method="GET" style="display: inline;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Pemilik
                        </button>
                    </form>
                </div>

                <br>
                
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemilik</th>
                            <th>No WA</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemilik as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->user->nama }}</td>
                            <td>{{ $$item->no_wa }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" onclick="window.location='#'">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Yaking Ingin menghapus data ini?')) { document.getElementById('delete-form-{{ $item->idpemilik }}').submit();}">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                                <form id="delete-form-{{ $item->idpemilik }}" action="#" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </main>
    </div>
</body>