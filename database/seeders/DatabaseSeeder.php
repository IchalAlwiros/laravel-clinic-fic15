<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin Ichal',
            'email' => 'ichal@example.com',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
            'phone' => '0866666666'
        ]);


        // Seeder profile profile_clinic manual
        \App\Models\ProfileClinic::factory()->create([
            'name' => 'Dokter Ichal',
            'email' => 'ichal@example.com',
            'address' => 'Jl Sana Sini',
            'phone' => '0866666666',
            'doctor_name' => 'Dr.Ichal',
            'unique_code' => '1231231',
        ]);


        // call (untuk memanggil seeder lain untuk dijalankan)
        $this->call(DoctorSeeder::class);
    }
}
