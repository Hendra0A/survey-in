<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JenisFasos;
use App\Models\DataSurvey;

class FasosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'data_survey_id' => $this->faker->randomElement(DataSurvey::pluck('id')),
            'jenis_fasos_id' => $this->faker->randomElement(JenisFasos::pluck('id')),
            'koordinat_fasos' => $this->faker->latitude() . " " . $this->faker->latitude(),
            'lebar' => mt_rand(1, 10),
            'panjang' => mt_rand(1, 10),
            'foto' => "https://source.unsplash.com/random"
        ];
    }
}
