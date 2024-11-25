<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinsiSeeder extends Seeder
{
    protected $provinsi = [
        ['PROVINSI' => 'ACEH'],
        ['PROVINSI' => 'SUMATERA UTARA'],
        ['PROVINSI' => 'SUMATERA BARAT'],
        ['PROVINSI' => 'RIAU'],
        ['PROVINSI' => 'JAMBI'],
        ['PROVINSI' => 'SUMATERA SELATAN'],
        ['PROVINSI' => 'BENGKULU'],
        ['PROVINSI' => 'LAMPUNG'],
        ['PROVINSI' => 'KEPULAUAN BANGKA BELITUNG'],
        ['PROVINSI' => 'KEPULAUAN RIAU'],
        ['PROVINSI' => 'DKI JAKARTA'],
        ['PROVINSI' => 'JAWA BARAT'],
        ['PROVINSI' => 'JAWA TENGAH'],
        ['PROVINSI' => 'DI YOGYAKARTA'],
        ['PROVINSI' => 'JAWA TIMUR'],
        ['PROVINSI' => 'BANTEN'],
        ['PROVINSI' => 'BALI'],
        ['PROVINSI' => 'NUSA TENGGARA BARAT'],
        ['PROVINSI' => 'NUSA TENGGARA TIMUR'],
        ['PROVINSI' => 'KALIMANTAN BARAT'],
        ['PROVINSI' => 'KALIMANTAN TENGAH'],
        ['PROVINSI' => 'KALIMANTAN SELATAN'],
        ['PROVINSI' => 'KALIMANTAN TIMUR'],
        ['PROVINSI' => 'KALIMANTAN UTARA'],
        ['PROVINSI' => 'SULAWESI UTARA'],
        ['PROVINSI' => 'SULAWESI TENGAH'],
        ['PROVINSI' => 'SULAWESI SELATAN'],
        ['PROVINSI' => 'SULAWESI TENGGARA'],
        ['PROVINSI' => 'GORONTALO'],
        ['PROVINSI' => 'SULAWESI BARAT'],
        ['PROVINSI' => 'MALUKU'],
        ['PROVINSI' => 'MALUKU UTARA'],
        ['PROVINSI' => 'PAPUA BARAT'],
        ['PROVINSI' => 'PAPUA'],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Provinsi::insert($this->provinsi);
    }
}
