<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user   = new User();
        
        $firstManager = $user->getManagerWithLeastSubordinates();
        $secondManager = $user->getManagerWithLeastSubordinates();

        return [
            'name' => $this->faker->name(),
            'lastname' => $this->faker->lastname(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'image'   => '',
            'role' => 'Subordinate',
            'managers' => json_encode([$firstManager,$secondManager]),
            'remember_token' => Str::random(10),
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
