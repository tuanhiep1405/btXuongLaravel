<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    protected $model = Classroom::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'teacher_name' => $this->faker->name(),
        ];
    }
}
