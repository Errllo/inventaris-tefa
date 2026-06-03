<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Peminjaman</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Edit Status / Data Peminjaman</h5>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    <ul class="mb-0 fs-7">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="post">
                @csrf
                @method('put')

                <input type="hidden" name="jumlah_pinjam" value="{{ $peminjaman->jumlah_pinjam }}">

                <div class="mb-3">
                    <label class="form-label">Nama Siswa (Peminjam)</label>
                    <select name="peminjam_id" class="form-select" required>
                        @foreach($peminjam as $p)
                            <option value="{{ $p->id }}" {{ $p->id == $peminjaman->peminjam_id ? 'selected' : '' }}>
                                {{ $p->nama_peminjam }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Barang yang Dipinjam</label>
                    <select name="barang_id" class="form-select" required>
                        @foreach($barang as $b)
                            <option value="{{ $b->id }}" {{ $b->id == $peminjaman->barang_id ? 'selected' : '' }}>
                                {{ $b->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control" value="{{ $peminjaman->tanggal_pinjam }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Peminjaman</label>
                    <select name="status_peminjaman" class="form-select" required>
                        <option value="dipinjam" {{ $peminjaman->status_peminjaman == 'dipinjam' ? 'selected' : '' }}>dipinjam</option>
                        <option value="dikembalikan" {{ $peminjaman->status_peminjaman == 'dikembalikan' ? 'selected' : '' }}>dikembalikan</option>
                        <option value="terlambat" {{ $peminjaman->status_peminjaman == 'terlambat' ? 'selected' : '' }}>terlambat</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success text-white">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
