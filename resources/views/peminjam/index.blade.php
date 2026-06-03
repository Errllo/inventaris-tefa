<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjam</title>
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
            <h4 class="mb-0 fw-bold">Daftar Peminjam</h4>
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
            <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary me-2 shadow-sm">Kelola Barang</a>
            <a href="{{ route('peminjam.index') }}" class="btn btn-secondary me-2 shadow-sm">Data Peminjam</a>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary shadow-sm">Kelola Peminjaman</a>
        </div>

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="6%" class="text-center py-3">No</th>
                                <th class="py-3 px-3">Nama Peminjam</th>
                                <th width="15%" class="text-center py-3">Kelas</th>
                                <th class="py-3 px-3">Jurusan</th>
                                <th width="20%" class="py-3 px-3">No HP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjam as $no => $p)
                            <tr>
                                <td class="text-center fw-bold text-secondary">{{ $no + 1 }}</td>
                                <td class="px-3 fw-semibold text-dark">{{ $p->nama_peminjam }}</td>
                                <td class="text-center"><span class="badge bg-secondary px-2.5 py-1.5">{{ $p->kelas }}</span></td>
                                <td class="px-3 text-secondary">{{ $p->jurusan }}</td>
                                <td class="px-3"><code class="text-dark">{{ $p->no_hp }}</code></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Data master peminjam kosong (Gunakan Seeder).</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
