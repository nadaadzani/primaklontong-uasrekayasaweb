<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Products::insert([[
            'gambar' => 'chikitwist.png',
            'nama' => 'Chiki Twist',
            'kategori' => 'Snack',
            'harga' => '10000',
            'deskripsi' => 'Camilan ringan yang terbuat dari tepung jagung dan bumbu-bumbu yang gurih. Dengan tekstur renyah dan rasa yang lezat, Chiki Twist menjadi pilihan favorit untuk menemani waktu santai atau sebagai teman nonton film. Cocok untuk semua kalangan, terutama anak-anak dan remaja.',
            'status' => 'tersedia'
        ], ['gambar' => 'milo.png',
            'nama' => 'Milo',
            'kategori' => 'Minuman',
            'harga' => '5000',
            'deskripsi' => 'Minuman berbahan dasar susu dan cokelat yang lezat dan menyegarkan. Milo adalah pilihan populer untuk sarapan atau sebagai camilan ringan.',
            'status' => 'hampir habis'
            ], ['gambar' => 'goodday.png',
            'nama' => 'Good Day',
            'kategori' => 'Minuman',
            'harga' => '6000',
            'deskripsi' => 'Minuman berbahan dasar susu dan kopi yang lezat dan menyegarkan. Good Day adalah pilihan populer untuk sarapan atau sebagai camilan ringan.',
            'status' => 'tersedia'
        ], ['gambar' => 'extrajoss.jpg',
            'nama' => 'Extra Joss',
            'kategori' => 'Minuman',
            'harga' => '4000',
            'deskripsi' => 'Minuman berbahan dasar susu dan kopi yang lezat dan menyegarkan. Extra Joss adalah pilihan populer untuk sarapan atau sebagai camilan ringan.',
            'status' => 'tersedia'
        ], ['gambar' => 'ademsari.jpg',
            'nama' => 'Adem Sari',
            'kategori' => 'Minuman',
            'harga' => '3000',
            'deskripsi' => 'Minuman berbahan dasar susu dan kopi yang lezat dan menyegarkan. Adem Sari adalah pilihan populer untuk sarapan atau sebagai camilan ringan.',
            'status' => 'habis'
        ], ['gambar' => 'mizone.jpg',
            'nama' => 'Mizone',
            'kategori' => 'Minuman',
            'harga' => '5000',
            'deskripsi' => 'Minuman berbahan dasar susu dan kopi yang lezat dan menyegarkan. Mizone adalah pilihan populer untuk sarapan atau sebagai camilan ringan.',
            'status' => 'tersedia']
            ]);
    }
}
