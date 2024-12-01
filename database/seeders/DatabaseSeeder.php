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
        
    }
}
