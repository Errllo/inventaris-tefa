<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang - Inventaris TEFA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Edit Data Barang</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="kategori_barang" class="form-label fw-semibold">Kategori Barang</label>
                                <input type="text" name="kategori_barang" id="kategori_barang" class="form-control" value="{{ old('kategori_barang', $barang->kategori_barang) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="stok" class="form-label fw-semibold">Stok Barang</label>
                                <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', $barang->stok) }}" required min="0">
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
