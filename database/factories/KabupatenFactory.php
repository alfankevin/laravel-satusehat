<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Kabupaten;

class KabupatenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kabupaten::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'KD_KABUPATEN' => $this->faker->word(),
            'KD_PROVINSI' => $this->faker->word(),
            'KABUPATEN' => $this->faker->word(),
            'ninput_oleh' => $this->faker->word(),
            'ninput_tgl' => $this->faker->word(),
            'nupdate_oleh' => $this->faker->word(),
            'nupdate_tgl' => $this->faker->word(),
        ];
    }
}
