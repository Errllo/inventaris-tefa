<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Kelola Barang - Inventaris TEFA</title>
</head>
<body class="bg-light">

    <div class="container mt-3 text-end">
        <span class="badge bg-secondary p-2">Login sebagai: {{ auth()->user()->name }}</span>
    </div>

    <div class="container mt-4">

        <div class="d-flex justify-content-center mb-4">
            <a href="{{ route('barang.index') }}" class="btn btn-secondary me-2 shadow-sm">Kelola Barang</a>

            <a href="#" class="btn btn-outline-secondary me-2 shadow-sm">Data Peminjam</a>

            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary shadow-sm">Kelola Peminjaman</a>

            <form action="{{ route('logout') }}" method="POST" class="ms-2" onsubmit="return confirm('Yakin ingin keluar?');">
                @csrf
                <button type="submit" class="btn btn-danger shadow-sm">Logout</button>
            </form>
        </div>

        @if(session('sukses'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Inventaris Barang</h5>
                <a href="{{ route('barang.create') }}" class="btn btn-sm btn-primary">Tambah Barang</a>
            </div>
            <div class="card-body">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barang as $index => $b)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $b->nama_barang }}</td>
                            <td>{{ $b->kategori_barang }}</td>
                            <td>{{ $b->stok }}</td>
                            <td>
                                <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('barang.destroy', $b->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data barang.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>
