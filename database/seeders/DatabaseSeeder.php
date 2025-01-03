<?php

namespace Database\Seeders;

use App\Models\KategoriPemeriksaan;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Practitioner;
use App\Models\PractitionerGroup;
use App\Models\Tkp;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Budi Santoso, A.Md. Kep',
            'email' => 'test@example.com',
            'password' => Hash::make('admin'),
        ]);

        PractitionerGroup::factory()->create([
            'namaGroup' => 'Dokter',
        ]);

        Tkp::factory()->create([
            'nmTkp' => "Rawat Jalan",
            'kdTkp' => "1",
        ]);
        
        $this->call([
            RolePermissionSeeder::class,
            ProvinsiSeeder::class,
            KabupatenSeeder::class,
            KecamatanSeeder::class,
            KelurahanSeeder::class,
            PoliSeeder::class,
            TindakanSeeder::class,
            KategoriPemeriksaanSeeder::class,
            ObatSeeder::class,
            DiagnosaSeeder::class,
            PractitionerSeeder::class,
            PasientSeeder::class,
        ]);

        
    }
}
