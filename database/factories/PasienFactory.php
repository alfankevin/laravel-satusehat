<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\KDKELURAHAN;
use App\Models\Pasien;

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
            'nomorRm' => $this->faker->numberBetween(1, 10000),
            'noKartu' => $this->faker->word(),
            'nama' => $this->faker->word(),
            'sex' => $this->faker->randomElement(['L', 'P']),
            'tglLahir' => $this->faker->date(),
            'jnsPeserta' => $this->faker->numberBetween(1, 10000),
            'golDarah' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'noHp' => $this->faker->word(),
            'noKtp' => $this->faker->word(),
            'pstProl' => $this->faker->word(),
            'pstPrb' => $this->faker->word(),
            'aktif' => $this->faker->boolean(),
            'ketAktif' => $this->faker->word(),
            'alamat' => $this->faker->address(),
            'created_by' => $this->faker->numberBetween(1, 10000),
            'updated_by' => $this->faker->numberBetween(1, 10000),
            'deleted_at' => $this->faker->dateTime(),
            'deleted_by' => $this->faker->numberBetween(1, 10000),
        ];
    }
}
