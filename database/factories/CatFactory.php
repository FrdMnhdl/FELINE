<?php

namespace Database\Factories;

use App\Models\Cat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cat>
 */
class CatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'breed' => fake()->randomElement([
                'Tabby Oren',
                'Russian Blue',
                'Scottish Fold',
                'Bombay',
                'Belang Tiga (Calico)',
                'Ragdoll',
                'British Shorthair',
            ]),
            'age' => fake()->randomElement(['8 bulan', '1 tahun', '2 tahun', '3 tahun', '4 tahun']),
            'gender' => fake()->randomElement(Cat::GENDERS),
            'description' => fake()->paragraph(2),
            'image_path' => 'cats/'.fake()->uuid().'.webp',
            'created_by' => User::factory()->admin(),
        ];
    }
}
