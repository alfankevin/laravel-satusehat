<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Practitioner;
use App\Models\PractitionerGroup;
use App\Models\Provinsi;
use App\Models\Tkp;
use DateTime;
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
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(RolePermissionSeeder::class);

        Provinsi::factory()->create([
            'KD_PROVINSI' => '0001',
            'PROVINSI' => 'Jawa Timur',
            'ninput_oleh' => '1',
            'ninput_tgl' => now()->format('Y-m-d'),
            'nupdate_oleh' => '1',
            'nupdate_tgl' => now()->format('Y-m-d'),
        ]);

        Kabupaten::factory()->create([
            'KD_KABUPATEN' => '1234',
            'KD_PROVINSI' => '0001',
            'KABUPATEN' => 'Surabaya',
            'ninput_oleh' => '1',
            'ninput_tgl' => now()->format('Y-m-d'),
            'nupdate_oleh' => '1',
            'nupdate_tgl' => now()->format('Y-m-d'),
        ]);

        Kecamatan::factory()->create([
            'KD_KECAMATAN' => '12345',
            'KD_KABUPATEN' => '1234',
            'KECAMATAN' => 'Wonocolo',
            'ninput_oleh' => '1',
            'ninput_tgl' => now()->format('Y-m-d'),
            'nupdate_oleh' => '1',
            'nupdate_tgl' => now()->format('Y-m-d'),
        ]);

        Kelurahan::factory()->create([
            'KD_KELURAHAN' => '1234',
            'KD_KECAMATAN' => '12345',
            'KELURAHAN' => 'Nginden',
            'ninput_oleh' => '1',
            'ninput_tgl' => now()->format('Y-m-d'),
            'nupdate_oleh' => '1',
            'nupdate_tgl' => now()->format('Y-m-d'),
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
        
        

        Pasien::factory(5)->create();
    }
}
