<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login - Inventaris Lab TEFA</title>
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">

<div class="container">
    <div class="card shadow-sm mx-auto" style="max-width: 400px;">
        <div class="card-header bg-dark text-white text-center py-3">
            <h5 class="mb-0">Inventaris Lab</h5>
        </div>
        <div class="card-body p-4">

            {{-- Notifikasi jika berhasil logout --}}
            @if(session('sukses'))
                <div class="alert alert-success py-2">{{ session('sukses') }}</div>
            @endif

            {{-- Menampilkan error jika email/password salah --}}
            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    <ul class="mb-0 px-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.proses') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="..." required>
                </div>
                <button type="submit" class="btn btn-dark w-100 mt-2">Masuk</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
