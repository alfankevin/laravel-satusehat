<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasien; // Pastikan model Pasien sudah dibuat

class PasientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data pasien
        $pasiens = [
            [
                'id' => 1,
                'nomorRm' => 1,
                'noKartu' => '33380139',
                'nama' => 'Floyd Predovic',
                'sex' => 'P',
                'tglLahir' => '1986-03-03',
                'jnsPeserta' => 1,
                'golDarah' => 'B',
                'noHp' => '+6285981725366',
                'noKtp' => '9104223107000004',
                'pstProl' => 'est',
                'pstPrb' => 'consequuntur',
                'aktif' => 1,
                'ketAktif' => 'qui',
                'alamat' => "63027 Kaylie Extensions\nSouth Greyson, MS 94441-2170",
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'deleted_by' => null,
                'KD_KELURAHAN' => 3517160007,
                'satusehat_id' => null,
                'created_at' => '2025-01-02 20:36:05',
                'updated_at' => '2025-01-02 20:36:05',
            ],
            [
                'id' => 2,
                'nomorRm' => 2,
                'noKartu' => '47736165',
                'nama' => 'Dr. Wendell Rowe',
                'sex' => 'P',
                'tglLahir' => '1990-04-17',
                'jnsPeserta' => 1,
                'golDarah' => 'A',
                'noHp' => '+6285939721770',
                'noKtp' => '9104224509000003',
                'pstProl' => 'quibusdam',
                'pstPrb' => 'aspernatur',
                'aktif' => 1,
                'ketAktif' => 'consequuntur',
                'alamat' => "3761 Effertz Forks\nRolandoshire, WI 12085-1256",
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'deleted_by' => null,
                'KD_KELURAHAN' => 3517160003,
                'satusehat_id' => null,
                'created_at' => '2025-01-02 20:36:05',
                'updated_at' => '2025-01-02 20:36:05',
            ],
            [
                'id' => 3,
                'nomorRm' => 3,
                'noKartu' => '90674243',
                'nama' => 'Rosanna Beahan II',
                'sex' => 'L',
                'tglLahir' => '1993-01-10',
                'jnsPeserta' => 2,
                'golDarah' => 'O',
                'noHp' => '+6285177973229',
                'noKtp' => '9104224606000005',
                'pstProl' => 'ut',
                'pstPrb' => 'hic',
                'aktif' => 1,
                'ketAktif' => 'molestias',
                'alamat' => "2460 Keenan Stravenue\nNew Ashachester, VT 35524-8076",
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'deleted_by' => null,
                'KD_KELURAHAN' => 3517160008,
                'satusehat_id' => '',
                'created_at' => '2025-01-02 20:36:05',
                'updated_at' => '2025-01-03 01:30:30',
            ],
            [
                'id' => 4,
                'nomorRm' => 4,
                'noKartu' => '62772695',
                'nama' => 'Emmanuelle Hettinger',
                'sex' => 'P',
                'tglLahir' => '2017-09-14',
                'jnsPeserta' => 2,
                'golDarah' => 'A',
                'noHp' => '+6285895652928',
                'noKtp' => '9271060312000001',
                'pstProl' => 'et',
                'pstPrb' => 'est',
                'aktif' => 0,
                'ketAktif' => 'occaecati',
                'alamat' => "97747 Reid Streets Suite 482\nNorth Marcoston, IA 13960-9974",
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'deleted_by' => null,
                'KD_KELURAHAN' => 3517100001,
                'satusehat_id' => '',
                'created_at' => '2025-01-02 20:36:05',
                'updated_at' => '2025-01-02 21:11:50',
            ],
            [
                'id' => 5,
                'nomorRm' => 5,
                'noKartu' => '07866630',
                'nama' => 'Gay Emmerich',
                'sex' => 'P',
                'tglLahir' => '2010-02-27',
                'jnsPeserta' => 2,
                'golDarah' => 'AB',
                'noHp' => '+6285670470749',
                'noKtp' => '9204014804000002',
                'pstProl' => 'expedita',
                'pstPrb' => 'est',
                'aktif' => 1,
                'ketAktif' => 'error',
                'alamat' => "790 Salvatore Way\nPaulineburgh, LA 54930-7217",
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'deleted_by' => null,
                'KD_KELURAHAN' => 3517100003,
                'satusehat_id' => '',
                'created_at' => '2025-01-02 20:36:05',
                'updated_at' => '2025-01-02 21:09:26',
            ],
        ];

        // Insert data ke database
        foreach ($pasiens as $pasien) {
            Pasien::create($pasien);
        }
    }
}
