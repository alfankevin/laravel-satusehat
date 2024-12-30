<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PractitionerSeeder extends Seeder
{
    public function run()
    {
        DB::table('practitioners')->insert([
            [
                'namaPractitioner' => 'Dr. Ahmad Fauzan',
                'nikPractitioner' => '1234567890123456',
                'practitioner_group_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaPractitioner' => 'Dr. Siti Aminah',
                'nikPractitioner' => '2345678901234567',
                'practitioner_group_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaPractitioner' => 'Dr. Budi Santoso',
                'nikPractitioner' => '3456789012345678',
                'practitioner_group_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaPractitioner' => 'Dr. Anita Lestari',
                'nikPractitioner' => '4567890123456789',
                'practitioner_group_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaPractitioner' => 'Dr. Rudi Hartono',
                'nikPractitioner' => '5678901234567890',
                'practitioner_group_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaPractitioner' => 'Dr. Lina Kusuma',
                'nikPractitioner' => '6789012345678901',
                'practitioner_group_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaPractitioner' => 'Dr. Hendra Wijaya',
                'nikPractitioner' => '7890123456789012',
                'practitioner_group_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaPractitioner' => 'Dr. Maria Clara',
                'nikPractitioner' => '8901234567890123',
                'practitioner_group_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaPractitioner' => 'Dr. Putra Aditya',
                'nikPractitioner' => '9012345678901234',
                'practitioner_group_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaPractitioner' => 'Dr. Dewi Sartika',
                'nikPractitioner' => '0123456789012345',
                'practitioner_group_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
