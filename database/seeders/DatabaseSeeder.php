<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\JamOperasional;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '0812345678901',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'nama' => 'Sopian Aji',
            'email' => 'sopian4ji@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('12345'),
        ]);

        // User
        User::create([
            'nama' => 'Wans',
            'email' => 'wan@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '081234567777',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'nama' => 'Laila Agustina',
            'email' => 'laila@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '081234162738',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'nama' => 'Dina Rahma',
            'email' => 'dina.rahma@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '082134567891',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'nama' => 'Yoga Saputra',
            'email' => 'yoga.saputra@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '082245678123',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'nama' => 'Fajar Nugraha',
            'email' => 'fajar.nugraha@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '081312345678',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'nama' => 'Amelia Putri',
            'email' => 'amelia.putri@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '085612345678',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'nama' => 'Budi Santoso',
            'email' => 'budi.santoso@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '082198765432',
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'nama' => 'Citra Lestari',
            'email' => 'citra.lestari@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '081234987654',
            'password' => bcrypt('12345'),
        ]);

        // Seeder Jam Operasional
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        foreach ($days as $day) {
            JamOperasional::create([
                'hari' => $day,
                'jam_buka' => '08:00:00',
                'jam_tutup' => '17:00:00',
                'status' => 'Aktif'
            ]);
        }
    }
}
