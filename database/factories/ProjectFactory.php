<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->numberBetween(100, 1000),
            'customer_id' => $this->faker->numberBetween(1,15),
            'type' => $this->faker->randomElement(['Activo', 'Soporte', 'Resolución piloto', 'Entregado seguimiento', 'No activo seguimiento']),
            'name' => $this->faker->name(),
            'priority' => $this->faker->numberBetween(1,10),
        ];
    }
}
