<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    public function run()
    {
        DB::table('polis')->insert([
            ['kodePoli' => 'POLI001', 'namaPoli' => 'Poli Umum', 'created_at' => now(), 'updated_at' => now()],
            ['kodePoli' => 'POLI002', 'namaPoli' => 'Poli Anak', 'created_at' => now(), 'updated_at' => now()],
            ['kodePoli' => 'POLI003', 'namaPoli' => 'Poli Gigi', 'created_at' => now(), 'updated_at' => now()],
            ['kodePoli' => 'POLI004', 'namaPoli' => 'Poli Kulit', 'created_at' => now(), 'updated_at' => now()],
            ['kodePoli' => 'POLI005', 'namaPoli' => 'Poli Mata', 'created_at' => now(), 'updated_at' => now()],
            ['kodePoli' => 'POLI006', 'namaPoli' => 'Poli Jantung', 'created_at' => now(), 'updated_at' => now()],
            ['kodePoli' => 'POLI007', 'namaPoli' => 'Poli Saraf', 'created_at' => now(), 'updated_at' => now()],
            ['kodePoli' => 'POLI008', 'namaPoli' => 'Poli THT', 'created_at' => now(), 'updated_at' => now()],
            ['kodePoli' => 'POLI009', 'namaPoli' => 'Poli Bedah', 'created_at' => now(), 'updated_at' => now()],
            ['kodePoli' => 'POLI010', 'namaPoli' => 'Poli Kandungan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
