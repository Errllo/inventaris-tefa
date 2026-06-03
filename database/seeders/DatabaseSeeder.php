<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Peminjam;
use App\Models\Barang;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        User::create([
            'name' => 'Elo',
            'email' => 'Elo@gmail.com',
            'password' => Hash::make('Elo123'),
        ]);

        peminjam::create([
            'nama_peminjam' => 'Elo Musk',
            'kelas' => 'XI',
            'jurusan' => 'PPLG 1',
            'no_hp' => '081234567890'
        ]);

        peminjam::create([
            'nama_peminjam' => 'Ocid Putra',
            'kelas' => 'XI',
            'jurusan' => 'PPLG 2',
            'no_hp' => '081234567891'
        ]);

        peminjam::create([
            'nama_peminjam' => 'Reza Ardiansyah',
            'kelas' => 'XI',
            'jurusan' => 'PPLG 1',
            'no_hp' => '081234567892'
        ]);


        barang::create([
            'nama_barang' => 'Laptop Asus',
            'kategori_barang' => 'Laptop',
            'stok' => 10,
        ]);

        barang::create([
            'nama_barang' => 'Mouse Logitech',
            'kategori_barang' => 'Aksesoris',
            'stok' => 15,
        ]);

        barang::create([
            'nama_barang' => 'Keyboard Mechanical',
            'kategori_barang' => 'Aksesoris',
            'stok' => 8,
        ]);
    }
}
