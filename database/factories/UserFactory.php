<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_lengkap' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'kabupaten_id' => 13,
            'password' => Hash::make('password'), // password
            'nomor_telepon' => $this->faker->phoneNumber(),
            'role' => 'surveyor',
            'alamat' => $this->faker->streetAddress(),
            'tanggal_lahir' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['laki-laki', 'perempuan'])
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
