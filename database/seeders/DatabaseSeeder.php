<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Sampah;
use App\Models\Nasabah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Hapus dan buat direktori untuk foto
        Storage::deleteDirectory('public/sampah');
        Storage::makeDirectory('public/sampah');
        
        Storage::deleteDirectory('public/nasabah');
        Storage::makeDirectory('public/nasabah');

        // 1. Buat Admin
        $admin = User::create([
            'name' => 'Admin Bank Sampah',
            'email' => 'admin@banksampah.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // 2. Buat Beberapa Nasabah Contoh
        $nasabahData = [
            [
                'user' => [
                    'name' => 'Nasabah Contoh 1',
                    'email' => 'nasabah1@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'nasabah',
                    'email_verified_at' => now(),
                ],
                'nasabah' => [
                    'nama' => 'Nasabah Contoh 1',
                    'alamat' => 'Jl. Contoh No. 123, Kota',
                    'no_telepon' => '081234567891',
                    'email' => 'nasabah1@example.com',
                    'foto' => $this->generateFakeNasabahImage('profile1.jpg'),
                ]
            ],
            [
                'user' => [
                    'name' => 'Nasabah Contoh 2',
                    'email' => 'nasabah2@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'nasabah',
                    'email_verified_at' => now(),
                ],
                'nasabah' => [
                    'nama' => 'Nasabah Contoh 2',
                    'alamat' => 'Jl. Contoh No. 456, Kota',
                    'no_telepon' => '081234567892',
                    'email' => 'nasabah2@example.com',
                    'foto' => $this->generateFakeNasabahImage('profile2.jpg'),
                ]
            ],
            [
                'user' => [
                    'name' => 'Nasabah Contoh 3',
                    'email' => 'nasabah3@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'nasabah',
                    'email_verified_at' => now(),
                ],
                'nasabah' => [
                    'nama' => 'Nasabah Contoh 3',
                    'alamat' => 'Jl. Contoh No. 789, Kota',
                    'no_telepon' => '081234567893',
                    'email' => 'nasabah3@example.com',
                    'foto' => null, // Tanpa foto
                ]
            ]
        ];

        foreach ($nasabahData as $data) {
            $user = User::create($data['user']);
            Nasabah::create(array_merge($data['nasabah'], ['user_id' => $user->id]));
        }

        // 3. Buat Data Jenis Sampah
        $sampahData = [
            [
                'jenis' => 'Plastik PET',
                'kategori' => 'Plastik',
                'harga_per_kg' => 3000,
                'deskripsi' => 'Botol plastik bening seperti botol air mineral',
                'foto' => $this->generateFakeSampahImage('plastik.jpg'),
            ],
            [
                'jenis' => 'Kertas HVS',
                'kategori' => 'Kertas',
                'harga_per_kg' => 2000,
                'deskripsi' => 'Kertas putih bekas print/ fotokopi',
                'foto' => $this->generateFakeSampahImage('kertas.jpg'),
            ],
            [
                'jenis' => 'Aluminium',
                'kategori' => 'Logam',
                'harga_per_kg' => 8000,
                'deskripsi' => 'Kaleng minuman dan makanan',
                'foto' => $this->generateFakeSampahImage('alumunium.jpg'),
            ],
            [
                'jenis' => 'Kardus',
                'kategori' => 'Kertas',
                'harga_per_kg' => 1500,
                'deskripsi' => 'Kardus bekas kemasan',
                'foto' => $this->generateFakeSampahImage('kardus.jpg'),
            ],
            [
                'jenis' => 'Besi',
                'kategori' => 'Logam',
                'harga_per_kg' => 5000,
                'deskripsi' => 'Besi bekas konstruksi',
                'foto' => $this->generateFakeSampahImage('besi.jpg'),
            ],
        ];

        foreach ($sampahData as $data) {
            Sampah::create($data);
        }
    }

    /**
     * Generate fake nasabah profile image path
     */
    private function generateFakeNasabahImage($imageName)
    {
        $filename = 'nasabah_' . uniqid() . '.jpg';
        $path = 'public/nasabah/' . $filename;
        
        // Simulasi: copy file contoh ke storage
        // Pastikan ada file contoh di public/images/nasabah-contoh/
        Storage::put($path, file_get_contents(public_path('images/nasabah-contoh/' . $imageName)));
        
        return 'nasabah/' . $filename;
    }

    /**
     * Generate fake sampah image path
     */
    private function generateFakeSampahImage($imageName)
    {
        $filename = 'sampah_' . uniqid() . '.jpg';
        $path = 'public/sampah/' . $filename;
        
        // Simulasi: copy file contoh ke storage
        // Pastikan ada file contoh di public/images/sampah-contoh/
        Storage::put($path, file_get_contents(public_path('images/sampah-contoh/' . $imageName)));
        
        return 'sampah/' . $filename;
    }

}