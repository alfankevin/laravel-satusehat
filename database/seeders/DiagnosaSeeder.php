<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiagnosaSeeder extends Seeder
{
    public function run()
    {
        DB::table('diagnosas')->insert([
            ['kode' => 'D001', 'diagnosa' => 'Demam Berdarah Dengue (DBD)', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D002', 'diagnosa' => 'Hipertensi', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D003', 'diagnosa' => 'Diabetes Mellitus', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D004', 'diagnosa' => 'Infeksi Saluran Pernafasan Akut (ISPA)', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D005', 'diagnosa' => 'Gagal Jantung', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D006', 'diagnosa' => 'Asma Bronkial', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D007', 'diagnosa' => 'Gastritis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D008', 'diagnosa' => 'Anemia', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D009', 'diagnosa' => 'Tuberkulosis Paru', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D010', 'diagnosa' => 'Infeksi Saluran Kemih', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D011', 'diagnosa' => 'Stroke Iskemik', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D012', 'diagnosa' => 'Stroke Hemoragik', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D013', 'diagnosa' => 'Penyakit Paru Obstruktif Kronis (PPOK)', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D014', 'diagnosa' => 'Hepatitis B', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D015', 'diagnosa' => 'Hepatitis C', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D016', 'diagnosa' => 'Penyakit Ginjal Kronis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D017', 'diagnosa' => 'Kanker Paru', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D018', 'diagnosa' => 'Kanker Payudara', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D019', 'diagnosa' => 'Kanker Serviks', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D020', 'diagnosa' => 'Depresi', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D021', 'diagnosa' => 'Skizofrenia', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D022', 'diagnosa' => 'Epilepsi', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D023', 'diagnosa' => 'Demensia Alzheimer', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D024', 'diagnosa' => 'Artritis Reumatoid', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D025', 'diagnosa' => 'Osteoarthritis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D026', 'diagnosa' => 'Psoriasis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D027', 'diagnosa' => 'Penyakit Alzheimer', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D028', 'diagnosa' => 'Lupus Eritematosus Sistemik (LES)', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D029', 'diagnosa' => 'Gagal Ginjal Akut', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'D030', 'diagnosa' => 'Alergi Makanan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
