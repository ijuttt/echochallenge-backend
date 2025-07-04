<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quest;

class QuestSeeder extends Seeder
{
    public function run(): void
    {
        $quests = [
            [ "quest"=> "Matikan lampu saat tidak digunakan di rumah", "point"=> 10 ],
            [ "quest"=> "Bawa tumbler sendiri saat membeli minuman di luar", "point"=> 15 ],
            [ "quest"=> "Gunakan transportasi umum untuk bepergian hari ini", "point"=> 25 ],
            [ "quest"=> "Jemur pakaian tanpa mesin pengering", "point"=> 10 ],
            [ "quest"=> "Bawa tas belanja sendiri saat belanja", "point"=> 12 ],
            [ "quest"=> "Gunakan kembali kantong plastik dari rumah", "point"=> 10 ],
            [ "quest"=> "Tutup keran saat menyikat gigi", "point"=> 8 ],
            [ "quest"=> "Isi ulang air minum di tempat refill terdekat", "point"=> 10 ],
            [ "quest"=> "Gunakan sabun batang daripada sabun cair dalam botol plastik", "point"=> 10 ],
            [ "quest"=> "Siram tanaman menggunakan air bekas cucian beras", "point"=> 20 ],
            [ "quest"=> "Bersihkan area sekitar dari sampah plastik", "point"=> 30 ],
            [ "quest"=> "Pisahkan sampah organik dan anorganik di rumah", "point"=> 15 ],
            [ "quest"=> "Ganti lampu biasa dengan lampu LED hemat energi", "point"=> 40 ],
            [ "quest"=> "Tanam satu tanaman di pot atau halaman rumah", "point"=> 25 ],
            [ "quest"=> "Buat kompos dari sampah dapur hari ini", "point"=> 30 ],
            [ "quest"=> "Gunakan kertas bekas untuk mencatat atau mencoret", "point"=> 8 ],
            [ "quest"=> "Cabut charger yang tidak digunakan dari stop kontak", "point"=> 5 ],
            [ "quest"=> "Bawa bekal makanan sendiri dari rumah", "point"=> 10 ],
            [ "quest"=> "Gunakan sabun cuci piring ramah lingkungan", "point"=> 15 ],
            [ "quest"=> "Foto produk lokal yang kamu beli hari ini", "point"=> 10 ],
            [ "quest"=> "Pakai ulang botol kaca untuk menyimpan bahan dapur", "point"=> 15 ],
            [ "quest"=> "Bersihkan selokan atau got kecil di lingkunganmu", "point"=> 35 ],
            [ "quest"=> "Gunakan kipas angin daripada AC hari ini", "point"=> 15 ],
            [ "quest"=> "Foto dirimu membaca buku bekas atau second-hand", "point"=> 8 ],
            [ "quest"=> "Gunakan alat makan non sekali pakai di luar rumah", "point"=> 10 ],
            [ "quest"=> "Foto produk refill yang kamu gunakan hari ini", "point"=> 15 ],
            [ "quest"=> "Perbaiki barang rusak agar tidak dibuang", "point"=> 30 ],
            [ "quest"=> "Cuci kendaraan tanpa menggunakan selang air", "point"=> 20 ],
            [ "quest"=> "Bersihkan pantai atau sungai terdekat dari sampah", "point"=> 50 ],
            [ "quest"=> "Gunakan pakaian yang sama lebih dari satu kali sebelum dicuci", "point"=> 10 ],
            [ "quest"=> "Gunakan sabun mandi isi ulang dari toko refill", "point"=> 12 ],
            [ "quest"=> "Foto kamu menggunakan sedotan stainless/eco", "point"=> 8 ],
            [ "quest"=> "Ganti tisu dengan sapu tangan sekali pakai hari ini", "point"=> 10 ],
            [ "quest"=> "Gunakan kendaraan listrik atau sepeda hari ini", "point"=> 30 ],
            [ "quest"=> "Cuci baju tanpa menggunakan mesin cuci", "point"=> 25 ],
            [ "quest"=> "Cuci tangan pakai sabun tanpa air mengalir terus", "point"=> 10 ],
            [ "quest"=> "Foto kamu sedang bawa sampah ke bank sampah", "point"=> 35 ],
            [ "quest"=> "Gunakan produk mandi tanpa kemasan plastik", "point"=> 15 ],
            [ "quest"=> "Foto kamu membawa bekas makanan ke tempat eco-enzyme", "point"=> 30 ],
            [ "quest"=> "Pakai pakaian bekas (thrift) hari ini", "point"=> 15 ],
            [ "quest"=> "Foto kamu saat menyiram tanaman rumah", "point"=> 10 ],
            [ "quest"=> "Gunakan kembali kotak makanan dari pembelian sebelumnya", "point"=> 12 ],
            [ "quest"=> "Foto kamu membaca info edukasi lingkungan dari papan/koran/poster", "point"=> 5 ],
            [ "quest"=> "Foto kamu sedang tidak menggunakan kantong plastik dari toko", "point"=> 10 ],
            [ "quest"=> "Gunakan alat cukur manual bukan elektrik", "point"=> 10 ],
            [ "quest"=> "Pakai ulang kemasan makanan untuk wadah penyimpanan", "point"=> 10 ],
            [ "quest"=> "Foto kamu mematikan semua peralatan listrik sebelum keluar rumah", "point"=> 15 ],
            [ "quest"=> "Gunakan satu gelas air untuk berkumur saat gosok gigi", "point"=> 5 ]
        ];
    
        foreach ($quests as $quest) {
            Quest::factory()->create($quest);
        }
    }

    
}

