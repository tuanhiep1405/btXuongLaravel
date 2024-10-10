<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->fake()->firstName, 
            'last_name' => $this->fake()->lastName,   
            'email' => $this->fake()->unique()->safeEmail, 
            'phone' => $this->fake()->phoneNumber,  
            'date_of_birth' => $this->fake()->date('Y-m-d', '2000-01-01'),
            'hire_date' => $this->fake()->dateTimeThisDecade(),
            'salary' => $this->fake()->randomFloat(2, 3000, 10000), 
            'is_active' => $this->fake()->boolean(), 
            'department_id' => $this->fake()->numberBetween(1, 10),
            'manager_id' => $this->fake()->numberBetween(1, 10), 
            'address' => $this->fake()->address, 
            'profile_picture' => $this->fake()->optional()->sha256, 
            'deleted_at' => null, 
            'created_at' => now(),
            'updated_at' => now(), 

        ];
    }
}
