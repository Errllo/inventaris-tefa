<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Peminjaman</title>
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
            <h4 class="mb-0 fw-bold">Kelola Peminjaman</h4>
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
            <a href="{{ route('peminjam.index') }}" class="btn btn-outline-secondary me-2 shadow-sm">Data Peminjam</a>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary shadow-sm">Kelola Peminjaman</a>
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
                                <th width="5%" class="text-center py-3">No</th>
                                <th class="py-3 px-3">Nama Siswa</th>
                                <th class="py-3 px-3">Nama Barang</th>
                                <th width="8%" class="text-center py-3">Jumlah</th>
                                <th class="py-3 px-3">Tgl Pinjam</th>
                                <th class="py-3 px-3">Tgl Kembali</th>
                                <th width="12%" class="text-center py-3">Status</th>
                                <th width="18%" class="text-center py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjaman as $no => $pj)
                            <tr>
                                <td class="text-center fw-bold text-secondary">{{ $no + 1 }}</td>
                                <td class="px-3 fw-semibold text-dark">{{ $pj->peminjam->nama_peminjam ?? 'Siswa Tidak Ditemukan' }}</td>
                                <td class="px-3 text-dark">{{ $pj->barang->nama_barang ?? 'Barang Terhapus' }}</td>
                                <td class="text-center fw-bold">{{ $pj->jumlah_pinjam }}</td>
                                <td class="px-3 text-secondary">{{ $pj->tanggal_pinjam }}</td>
                                <td class="px-3 text-secondary">{{ $pj->tanggal_kembali }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $pj->status_peminjaman == 'dipinjam' ? 'bg-warning text-dark' : 'bg-success' }} px-2.5 py-1.5">
                                        {{ $pj->status_peminjaman }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('peminjaman.destroy', $pj->id) }}" method="post" onsubmit="return confirm('Hapus riwayat ini?')">
                                        <a href="{{ route('peminjaman.edit', $pj->id) }}" class="btn btn-warning btn-sm fw-semibold me-1">Edit</a>
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm fw-semibold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Belum ada riwayat transaksi peminjaman barang.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mb-5">
            <a href="{{ route('peminjaman.create') }}" class="btn btn-primary fw-semibold shadow-sm px-4 py-2">
                + Pinjam Barang Baru
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
