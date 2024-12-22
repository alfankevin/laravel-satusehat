<?php

namespace Database\Seeders;
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
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('admin'),
        ]);

        Poli::factory()->create([
            'kodePoli' => '1234',
            'namaPoli' => 'Poli Umum',
        ]);

        PractitionerGroup::factory()->create([
            'namaGroup' => 'Dokter',
        ]);

        Practitioner::factory()->create([
            'namaPractitioner' => 'Budi Sntoso',
            'nikPractitioner' => '123345566',
            'practitioner_group_id' => PractitionerGroup::factory(),
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
            KelurahanSeeder::class
        ]);

        Pasien::factory(5)->create();
        
        \App\Models\Obat::factory()->create([
            'id' => 1,
            'nama_obat' => 'Paramex',
            'harga' => 10000,
            'stok' => 10,
        ]);
        \App\Models\Obat::factory()->create([
            'id' => 2,
            'nama_obat' => 'Amoxicillin',
            'harga' => 70000,
            'stok' => 10,
        ]);
        \App\Models\Obat::factory()->create([
            'id' => 3,
            'nama_obat' => 'Metformin',
            'harga' => 50000,
            'stok' => 10,
        ]);
        \App\Models\Obat::factory()->create([
            'id' => 4,
            'nama_obat' => ' Sulfonilurea',
            'harga' => 100000,
            'stok' => 10,
        ]);
        \App\Models\Obat::factory()->create([
            'id' => 5,
            'nama_obat' => 'Thiazolidinediones',
            'harga' => 200000,
            'stok' => 10,
        ]);
        \App\Models\Obat::factory()->create([
            'id' => 6,
            'nama_obat' => 'Gliptin',
            'harga' => 80000,
            'stok' => 10,
        ]);

        \App\Models\Diagnosa::factory()->create([
            'id' => 1,
            'kode' => 'D001',
            'diagnosa' => 'ISPA',
        ]);
        \App\Models\Diagnosa::factory()->create([
            'id' => 2,
            'kode' => 'D002',
            'diagnosa' => 'Aanemia',
        ]);
        \App\Models\Diagnosa::factory()->create([
            'id' => 3,
            'kode' => 'D003',
            'diagnosa' => 'Diabetes melitus',
        ]);

        \App\Models\Tindakan::factory()->create([
            'id' => 1,
            'tindakan' => 'Suntik Antibiotik',
            'biaya' => 100000,
        ]);
        \App\Models\Tindakan::factory()->create([
            'id' => 2,
            'tindakan' => 'Suntik NovoRapid',
            'biaya' => 120000,
        ]);
        \App\Models\Tindakan::factory()->create([
            'id' => 3,
            'tindakan' => 'Infus',
            'biaya' => 450000,
        ]);
        \App\Models\Tindakan::factory()->create([
            'id' => 4,
            'tindakan' => 'Nebulizer',
            'biaya' => 150000,
        ]);

        \App\Models\KategoriPemeriksaan::factory()->create([
            'id' => 1,
            'pemeriksaan' => 'Tes Darah',
            'biaya' => 60000,
        ]);
        \App\Models\KategoriPemeriksaan::factory()->create([
            'id' => 2,
            'pemeriksaan' => 'Pemeriksaan Urine',
            'biaya' => 150000,
        ]);
        \App\Models\KategoriPemeriksaan::factory()->create([
            'id' => 3,
            'pemeriksaan' => 'Rontgen Thorax',
            'biaya' => 120000,
        ]);
        \App\Models\KategoriPemeriksaan::factory()->create([
            'id' => 4,
            'pemeriksaan' => 'Gula Darah Puasa',
            'biaya' => 150000,
        ]);
    }
}
