<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pasien;
use App\Models\Provinsi;

class PasienFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pasien::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nomorRm' => $this->faker->numberBetween(-10000, 10000),
            'noKartu' => $this->faker->regexify('[A-Za-z0-9]{13}'),
            'nama' => $this->faker->word(),
            'hubunganKeluarga' => $this->faker->word(),
            'sex' => $this->faker->randomLetter(),
            'tglLahir' => $this->faker->date(),
            'jnsPeserta' => $this->faker->numberBetween(-10000, 10000),
            'golDarah' => $this->faker->word(),
            'noHp' => $this->faker->word(),
            'noKtp' => $this->faker->word(),
            'pstProl' => $this->faker->word(),
            'pstPrb' => $this->faker->word(),
            'aktif' => $this->faker->boolean(),
            'ketAktif' => $this->faker->word(),
            'created_by' => $this->faker->numberBetween(-10000, 10000),
            'updated_by' => $this->faker->numberBetween(-10000, 10000),
            'deleted_at' => $this->faker->dateTime(),
            'deleted_by' => $this->faker->numberBetween(-10000, 10000),
            'provinsi_id' => Provinsi::factory(),
            'kabupaten_id' => Kabupaten::factory(),
            'kecamatan_id' => Kecamatan::factory(),
            'kelurahan_id' => Kelurahan::factory(),
        ];
    }
}
