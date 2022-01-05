<?php

namespace Database\Factories;

use App\Models\DataSurvey;
use App\Models\JenisLampiran;
use Illuminate\Database\Eloquent\Factories\Factory;

class LampiranFotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dataSurvey_id = DataSurvey::pluck('id');
        $jenisLampiran_id = JenisLampiran::pluck('id');

        return [
            'data_survey_id' => $this->faker->randomElement($dataSurvey_id),
            'jenis_lampiran_id' => $this->faker->randomElement($jenisLampiran_id),
            'foto' => 'https://source.unsplash.com/random?road;building'
        ];
    }
}
