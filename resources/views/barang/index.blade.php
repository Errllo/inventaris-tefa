<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .full-header {
            border-radius: 0 !important;
        }
    </style>
</head>
<body class="bg-light">

    <div class="card bg-dark text-white full-header shadow-sm border-0 mb-4">
        <div class="container-fluid px-4 py-3 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 fw-bold">Daftar Barang</h4>

            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('keluar aplikasi?')">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm fw-semibold shadow-sm px-3">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="container">

        <div class="d-flex justify-content-center mb-4">
            <a href="{{ route('barang.index') }}" class="btn btn-secondary me-2 shadow-sm">Kelola Barang</a>
            <a href="{{ route('peminjam.index') }}" class="btn btn-outline-secondary me-2 shadow-sm">Data Peminjam</a>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary shadow-sm">Kelola Peminjaman</a>
        </div>

        @if(session('sukses'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="6%" class="text-center py-3">No</th>
                                <th class="py-3 px-3">Nama Barang</th>
                                <th class="py-3 px-3">Kategori</th>
                                <th width="15%" class="py-3 px-3">Stok</th>
                                <th width="18%" class="text-center py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barang as $no => $b)
                            <tr>
                                <td class="text-center fw-bold text-secondary">{{ $no + 1 }}</td>
                                <td class="px-3 fw-semibold text-dark">{{ $b->nama_barang }}</td>
                                <td class="px-3 text-secondary">{{ $b->kategori_barang }}</td>
                                <td class="px-3"><span class="badge bg-secondary px-2.5 py-1.5">{{ $b->stok }}</span></td>
                                <td class="text-center">
                                    <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-warning btn-sm fw-semibold me-1">Edit</a>

                                    <form action="{{ route('barang.destroy', $b->id) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin mau hapus?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm fw-semibold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mb-5">
            <a href="{{ route('barang.create') }}" class="btn btn-primary fw-semibold shadow-sm px-4 py-2">
                + Tambah Barang Baru
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
