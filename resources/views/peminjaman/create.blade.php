<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Form Peminjaman Barang Baru</h5>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('peminjaman.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Siswa (Peminjam)</label>
                    <select name="peminjam_id" class="form-select" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($peminjam as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_peminjam }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Barang yang Dipinjam</label>
                    <select name="barang_id" class="form-select" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} (Stok: {{ $b->stok }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Pinjam</label>
                    <input type="number" name="jumlah_pinjam" class="form-control" placeholder="Contoh: 1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Peminjaman</label>
                    <select name="status_peminjaman" class="form-select" required>
                        <option value="dipinjam">dipinjam</option>
                        <option value="dikembalikan">dikembalikan</option>
                        <option value="terlambat">terlambat</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Proses Pinjam</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
