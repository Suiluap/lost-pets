<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'picture' => 'cat.jpg',
            'description' => $this->faker->paragraph(),
            'date' => $this->faker->date(),
            'address' => $this->faker->address(),
            'user_id' => 1,
            'status_id' => 1
        ];
    }
}
