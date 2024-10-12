<?php

namespace Database\Factories;

use App\Models\Passport;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passport>
 */
class PassportFactory extends Factory
{
    protected $model = Passport::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(),
            'passport_number' => $this->faker->unique()->regexify('[A-Z0-9]{8}'),
            'issued_date' => $this->faker->date(),
            'expiry_date' => $this->faker->date('Y-m-d', '2030-12-31'),
        ];
    }
}
